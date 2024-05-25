<?php

namespace App\Http\Controllers;

use App\Exports\DataAdminExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

class ExportController extends Controller
{
    public function export_excel_dataadmin()
    {
        return Excel::download(new DataAdminExport(), 'data_admin.xlsx');
    }
   
    public function exportPDF_dataadmin()
    {
        // Contoh logika untuk membuat PDF menggunakan library Dompdf
        $data = ['foo' => 'bar'];
        $pdf = PDF::loadView('pdf.export', $data);

        // Menghasilkan dan mengirimkan PDF ke browser
        return $pdf->download('export.pdf');
    }
}
