<div class="tab-pane fade" id="order-chart" role="tabpanel" aria-labelledby="order-chart-tab">
    <h3 class="ml-3"Đơn hàng</h3>
    <label for="order-year-select" class="ml-3">Chọn năm:</label>
    <select id="order-year-select" class="form-control col-3 ml-3">
        @foreach(range(date('Y'), date('Y') - 10) as $year)
            <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
    </select>
    <canvas id="orderChart"></canvas>
</div>
