<div class="tab-pane fade" id="order-chart" role="tabpanel" aria-labelledby="order-chart-tab">
    <h3 class="ml-3">Đơn hàng</h3>
    <form method="GET" action="{{ route('admin.manage.show-chart') }}">
        <label for="year" >SỐ LIỆU THỐNG KÊ NĂM:</label>
        <select name="year" id="year" onchange="this.form.submit()" >
            @foreach($years as $year)
                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </form>
    <canvas id="orderChart"></canvas>
    <input type="hidden" id="chartMonths" value='@json($months)'>
    <input type="hidden" id="chartOrderCounts" value='@json($orderCounts)'>
</div>
