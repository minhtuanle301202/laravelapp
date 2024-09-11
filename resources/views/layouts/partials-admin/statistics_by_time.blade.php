<div class="tab-pane fade" id="statistics-by-time" role="tabpanel" aria-labelledby="statistics-by-time-tab">
    <h2 class="ml-3">SỐ LIỆU THỐNG KÊ THEO THỜI GIAN</h2>
    <div class="row mb-4 align-items-end ml-3">
        <div class="col-md-5 pl-0">
            <label for="startDate">Từ ngày:</label>
            <div class="input-group">
                <input type="text" class="form-control datepicker" id="startDate" name="start_date" placeholder="mm/dd/yyyy">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <label for="endDate">Đến ngày:</label>
            <div class="input-group">
                <input type="text" class="form-control datepicker" id="endDate" name="end_date" placeholder="mm/dd/yyyy">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 align-items-end ml-3">
        <div class="col-md-5 pl-0">
            <label for="sortOrder">Sắp xếp theo:</label>
            <select class="form-control" id="sortOrder" name="sort_order">
                <option value="desc">Giảm dần</option>
                <option value="asc">Tăng dần</option>
            </select>
        </div>
        <div class="col-md-5">
            <label for="sortBy">Tiêu chí:</label>
            <select class="form-control" id="sortBy" name="sort_by">
                <option value="total_quantity">Số lượng đã bán</option>
                <option value="total_revenue">Doanh thu đã bán</option>
            </select>
        </div>
    </div>
    <button class="btn-search ml-3">Thống kê</button>

    <div class="topProducts-content">
        @include('layouts.partials-admin.statistics_table',['topProducts' => $topProducts])
    </div>
        <input type="hidden" name="page-numbers"  id="page-numbers" value="1">
        <div class="pagination-top-products">
            <button id="prev-top-products" class="prev-top-products">
                << Previous
            </button>
            <button id="next-top-products" class="next-top-products">
                Next >>
            </button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/admin/manage_statistics_products.js') }}"></script>


