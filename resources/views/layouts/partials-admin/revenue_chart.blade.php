<div class="tab-pane fade show active" id="revenue-chart" role="tabpanel" aria-labelledby="revenue-chart-tab">
    <h3 class="ml-3">Doanh thu</h3>
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
    <canvas id="revenueChart"></canvas>
    <input type="hidden" id="chartMonths" value='@json($months)'>
    <input type="hidden" id="chartRevenue" value='@json($revenue)'>
</div>

