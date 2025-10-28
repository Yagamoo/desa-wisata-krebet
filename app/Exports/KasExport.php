<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KasExport implements FromCollection, WithHeadings
{
    protected $pemasukans;
    protected $pengeluarans;

    public function __construct($pemasukans, $pengeluarans)
    {
        $this->pemasukans = $pemasukans;
        $this->pengeluarans = $pengeluarans;
    }

    public function collection()
    {
        $rows = new Collection();

        $rows->push(['Pemasukan']); // Judul Pemasukan
        $rows->push(['No', 'Tanggal', 'Keterangan', 'Jumlah', 'Bukti', 'Status']);

        foreach ($this->pemasukans as $index => $p) {
            $rows->push([
                $index + 1,
                \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y'),
                $p->keterangan,
                $p->jumlah,
                $p->bukti ? asset('storage/' . $p->bukti) : '-',
                $p->status
            ]);
        }

        $rows->push([]); // kosong untuk spasi
        $rows->push(['Pengeluaran']); // Judul Pengeluaran
        $rows->push(['No', 'Tanggal', 'Keterangan', 'Jumlah', 'Bukti', 'Status']);

        foreach ($this->pengeluarans as $index => $p) {
            $rows->push([
                $index + 1,
                \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y'),
                $p->keterangan,
                $p->jumlah,
                $p->bukti ? asset('storage/' . $p->bukti) : '-',
                $p->status
            ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [];
    }
}