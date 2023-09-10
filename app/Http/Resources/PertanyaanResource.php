<?php

namespace App\Http\Resources;

use App\Models\PertanyaanBalasan;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PertanyaanResource extends ResourceCollection
{
    public function toArray($request)
    {
        $this->tampungdatarow = [];
        $this->collection->transform(function ($pertanyaan) {
            $row['customer'] = $pertanyaan->user->name;
            $row['pertanyaan'] = $pertanyaan->pertanyaan;
            $row['time'] = $pertanyaan->created_at->diffForHumans();
            $datapertanyaanbaladan = PertanyaanBalasan::with('user')->where('id_pertanyaan', $pertanyaan->id)->orderBy('created_at', 'asc')->firstOrFail();
            $datapertanyaanbaladancount = PertanyaanBalasan::where('id_pertanyaan', $pertanyaan->id)->count();
            if ($datapertanyaanbaladan) {
                $row['balasan']['jawaban'] = $datapertanyaanbaladan->user->name;
                $row['balasan']['pertanyaan'] = $datapertanyaanbaladan->balasan;
            }

            if ($datapertanyaanbaladancount - 1 === 0) {
                $row['balasan']['lainnya'] = false;
            } else {

                $row['balasan']['lainnya'] = $datapertanyaanbaladancount - 1 . ' jawaban lainnya';
            }
            array_push($this->tampungdatarow, $row);
        });
        return [
            'data' =>  $this->tampungdatarow
        ];
    }
}
