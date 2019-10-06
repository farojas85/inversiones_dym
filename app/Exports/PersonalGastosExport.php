<?php

namespace App\Exports;

use App\PersonalGasto;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Session;

class PersonalGastosExport implements FromArray, WithHeadings, WithColumnFormatting,ShouldAutoSize,WithEvents
{
    protected $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
        Session::forget('personalgastos');
    }

    public function array(): array
    {
        return $this->datos;
    }
    public function headings() : array
    {
        return [
            'PERSONAL',
            'FECHA',
            'DESCRIPCIÓN',
            'MONTO'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $cellRange = 'A1:D1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' =>Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                                ]
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'font' => array(
                            'name' => 'Calibri',
                            'size' => 12,
                            'color' => array('rgb' => 'FFFFFF')
                        ),
                    )
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                                        ->setFillType(Fill::FILL_SOLID)
                                        ->getStartColor()->setRGB('0489B1');

                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);
            },
        ];
    }
}
