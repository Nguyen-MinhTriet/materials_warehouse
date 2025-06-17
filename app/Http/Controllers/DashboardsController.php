<?php

namespace App\Http\Controllers;

use App\Models\export_receipt;
use App\Models\import_receipt;
use App\Models\kho;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class DashboardsController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new kho())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index(Request $request)
    {
        // Cố định thời gian cho toàn bộ năm hiện tại
        $currentYear = now()->year; // Lấy năm hiện tại (2025)
        $startDate = Carbon::create($currentYear, 1, 1)->toDateString(); // Đầu năm, ví dụ: 2025-01-01
        $endDate = Carbon::create($currentYear, 12, 31)->toDateString(); // Cuối năm, ví dụ: 2025-12-31
        Log::info('Start Date: ' . $startDate . ', End Date: ' . $endDate);

        // Thống kê doanh thu phiếu nhập
        $importRevenue = import_receipt::selectRaw('MONTH(issued_date) as month, YEAR(issued_date) as year, SUM(total_amount) as total')
            ->whereBetween('issued_date', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->keyBy(function ($item) {
                return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
            });
        Log::info('Raw Import Revenue Query: ', $importRevenue->toArray());

        $importRevenue = $importRevenue->keyBy(function ($item) {
            return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
        });
        Log::info('Import Revenue: ', $importRevenue->toArray());

        // Thống kê doanh thu phiếu xuất
        $exportRevenue = export_receipt::selectRaw('MONTH(issued_date) as month, YEAR(issued_date) as year, SUM(total_amount) as total')
            ->whereBetween('issued_date', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->keyBy(function ($item) {
                return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
            });
        Log::info('Raw Export Revenue Query: ', $exportRevenue->toArray());

        $exportRevenue = $exportRevenue->keyBy(function ($item) {
            return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
        });
        Log::info('Export Revenue: ', $exportRevenue->toArray());

        // Chuẩn bị dữ liệu cho biểu đồ
        $months = [];
        $importData = [];
        $exportData = [];
        $viMonthNames = [
            1 => 'Tháng 1',
            2 => 'Tháng 2',
            3 => 'Tháng 3',
            4 => 'Tháng 4',
            5 => 'Tháng 5',
            6 => 'Tháng 6',
            7 => 'Tháng 7',
            8 => 'Tháng 8',
            9 => 'Tháng 9',
            10 => 'Tháng 10',
            11 => 'Tháng 11',
            12 => 'Tháng 12',
        ];

        for ($month = 1; $month <= 12; $month++) {
            $monthKey = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
            $months[] = $viMonthNames[$month];

            // Lấy giá trị doanh thu từ importRevenue và exportRevenue cho tháng này
            $importData[] = $importRevenue->has($monthKey) ? $importRevenue[$monthKey]['total'] : 0;
            $exportData[] = $exportRevenue->has($monthKey) ? $exportRevenue[$monthKey]['total'] : 0;
        }

        Log::info('Months from Controller: ', $months);
        Log::info('Import Data: ', $importData);
        Log::info('Export Data: ', $exportData);

        // Thống kê tổng tiền phiếu xuất theo ngày (biểu đồ mới)
        $startDateDay = '2025-06-01'; // Ví dụ: bắt đầu từ 01/05/2025
        $endDateDay = '2025-07-01';   // Ví dụ: kết thúc tại 01/06/2025
        Log::info('Start Date (Day): ' . $startDateDay . ', End Date (Day): ' . $endDateDay);

        $exportRevenueByDay = export_receipt::selectRaw('DATE(issued_date) as day, SUM(total_amount) as total')
            ->whereBetween('issued_date', [$startDateDay, $endDateDay])
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get()
            ->keyBy('day');

        Log::info('Export Revenue by Day: ', $exportRevenueByDay->toArray());

        // Chuẩn bị dữ liệu cho biểu đồ theo ngày
        $days = []; // Đảm bảo biến $days được định nghĩa
        $exportDataByDay = [];

        $currentDate = Carbon::parse($startDateDay);
        $endDateObj = Carbon::parse($endDateDay);

        while ($currentDate <= $endDateObj) {
            $dayKey = $currentDate->toDateString();
            $days[] = $currentDate->format('d/m/Y');
            $exportDataByDay[] = $exportRevenueByDay->has($dayKey) ? $exportRevenueByDay[$dayKey]['total'] : 0;
            $currentDate->addDay();
        }

        Log::info('Days: ', $days);
        Log::info('Export Data by Day: ', $exportDataByDay);

        // Trả về view với tất cả dữ liệu

       // return view('Dashboards.index', compact('months', 'importData', 'exportData', 'startDate', 'endDate'));
        return view('Dashboards.index', compact('months', 'importData', 'exportData', 'startDate', 'endDate', 'days', 'exportDataByDay', 'startDateDay', 'endDateDay'));

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $this->model->create($request->validated());
        return redirect()->route('categorys.index')->with('success', 'Danh mục đã được tạo.');
    }

    /**
     * Display the specified resource.
     */
    public function show($category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category)
    {
        return view('category.edit', ['each' => $category,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $categoryId)
    {

        $object = $this->model->find($categoryId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('categorys.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category, $categoryId)
    {
        $this->model->where('id', $categoryId)->delete();
        // return redirect()->route('categorys.index')->with('success','Xoá danh mục thành công!');
        // Category::destroy($category);
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
