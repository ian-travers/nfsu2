<?php

namespace App\Models\NFSUServer;

use Carbon\Carbon;

class RealServer implements ServerInterface
{
    use ServerInfo;

    private string $_rawData;

    public function __construct(string $ip, string $port)
    {
        $this->ip = $ip;
        $this->isOnline = false;

        $fp = @fsockopen($ip, $port, $errNo, $errStr, 10);

        if ($fp) {
            $this->isOnline = true;
            $this->_rawData = fgets($fp);
            $this->initialize();
        }
    }

    public function initialize()
    {
        /*
         * 0|20|1650849|*nix|2.5|NFSU Cup|0|0|0~~~A.GLOBAL|0|[]A.SANDBOX|0|[]B.GLOBAL|0|[]B.SANDBOX|0|[]C.GLOBAL|0|[]C.SANDBOX|0|[]D.GLOBAL|0|[]D.SANDBOX|0|[]E.GLOBAL|0|[]E.SANDBOX|0|[]E.TOURNEY|0|[]F.GLOBAL|0|[]F.SANDBOX|0|[]F.TOURNEY|0|[]G.GLOBAL|0|[]G.SANDBOX|0|[]G.TOURNEY|0|[]H.GLOBAL|0|[]H.SANDBOX|0|[]H.TOURNEY|0|[]
         */

        if (strlen(trim($this->_rawData)) > 0) {

            // Separate Overall server data and Rooms data
            $data = explode('~~~', $this->_rawData);
            $overall_data = $data[0];
            $rooms_data = $data[1];

            // Get overall server parameters
            $data = explode('|', $overall_data);
            $this->playersCount = $data[0];
            $this->roomsCount = $data[1];
            $this->onlineTime = $data[2];
            $this->platform = $data[3];
            $this->version = $data[4];
            $this->name = $data[5];

            if ($this->version == '2.5') {
                $this->banCheaters = $data[6];
                $this->playersInRaces = $data[7];
                $this->banNewRooms = $data[8];
            }

            // Get Rooms info
            $arr_rooms = explode(']', $rooms_data);
            $rooms = [];

            for ($i = 0; $i < count($arr_rooms); $i++) {
                $temp_data = explode('[', $arr_rooms[$i]);
                $room_data = explode('|', $temp_data[0]);

                if (count($room_data) < 2) {
                    $room_data[1] = 0;
                }

                $room_internal_name = str_replace('"', '', $room_data[0]);
                $room_type = substr($room_internal_name, 0, 1);
                $room_name = substr($room_internal_name, 2);
                $room_players_count = $room_data[1];

                $players = [];

                if ((int)$room_data[1] > 0) {
                    $players_names = explode('|', $temp_data[1]);
                    for ($j = 0; $j < count($players_names); $j++) {
                        if (strlen(trim($players_names[$j]))) {
                            $players[] = $players_names[$j];
                        }
                    }
                }

                $rooms[] = [
                    'type' => $room_type,
                    'name' => $room_name,
                    'count' => $room_players_count,
                    'players' => $players,
                ];
            }

            foreach ($rooms as $room) {
                switch ($room['type']) {
                    case 'A':
                        array_push($this->roomsA, $room);
                        break;
                    case 'B':
                        array_push($this->roomsB, $room);
                        break;
                    case 'C':
                        array_push($this->roomsC, $room);
                        break;
                    case 'D':
                        array_push($this->roomsD, $room);
                        break;
                    case 'E':
                        array_push($this->roomsE, $room);
                        break;
                    case 'F':
                        array_push($this->roomsF, $room);
                        break;
                    case 'G':
                        array_push($this->roomsG, $room);
                        break;
                    case 'H':
                        array_push($this->roomsH, $room);
                        break;
                }
            }
        }
    }

    public function onlineTimeForHumans(): string
    {
        $d = Carbon::now();
        $d->subSeconds($this->onlineTime);

        return __('Online since') . ' ' . $d->format('d.m.Y') . ' (' . $d->longAbsoluteDiffForHumans() . ').';
    }
}
