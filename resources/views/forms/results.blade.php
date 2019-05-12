<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /*.pie-chart,
        .horizontal-chart {
            width: 700px;
            height: 380px;
        }*/

        .clearfix:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }

        .wrapper {
            display: block;
            overflow: hidden;
        }

        .page {
            overflow: hidden;
            page-break-after: avoid;
        }
    </style>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
        function init() {
            google.load("visualization", "1.1", {
                packages: ["corechart", "bar"],
                callback: 'drawCharts'
            });
        }

        function drawCharts() {
            @foreach($diagrams as $index => $diagram)
                @if($diagram['diagram'] !== 'list')
                    var data_{{ $index }} = google.visualization.arrayToDataTable([
                            ['Ответ', 'Количество'],
                                    @foreach($diagram['answers'] as $answer)
                            ['{{ $answer['title'] . ' (' . $answer['percentage'] . '%)' }}', {{ $answer['count'] }}]{{ !$loop->last ? ',' : '' }}
                                @endforeach
                        ]);

                    @if($diagram['diagram'] === 'pie')
                        var options_{{ $index }} = {
                            width: 900,
                            height: 380,
                            chartArea: { left:20, width: 750},
                        };
                        var chart_{{ $index }} = new google.visualization.PieChart(document.getElementById('{{ $diagram['diagram'] }}-chart-{{ $index }}'));
                    @else
                        var options_{{ $index }} = {
                            width: 900,
                            height: 360,
                            legend: {position: 'none'},
                            chartArea: { left:300, width: 400},
                            hAxis: {
                                minValue: 0
                            }
                        };
                        var chart_{{ $index }} = new google.visualization.BarChart(document.getElementById('{{ $diagram['diagram'] }}-chart-{{ $index }}'));
                    @endif

                    chart_{{ $index }}.draw(data_{{ $index }}, options_{{ $index }});
                @endif
            @endforeach
        }
    </script>
</head>
<body onload="init()">
<h1 style="text-align: center">Результаты опроса<br/>"{{ $form->getTitle() }}"</h1>
<h2 style="text-align: center">Всего проголосовало: {{ $form->answers_count }}</h2>

<div class="page">
    @foreach($diagrams as $index => $diagram)
        <h3>{{ $index + 1 }}. {{ $diagram['question_title'] }}</h3>

        @if($diagram['diagram'] !== 'list')
            <div class="wrapper">
                <div id="{{ $diagram['diagram'] }}-chart-{{ $index }}" class="{{ $diagram['diagram'] }}-chart"></div>
            </div>
        @else
            <ul>
                @foreach($diagram['answers'] as $answer)
                    <li>{{ $answer }}</li>
                @endforeach
            </ul>
        @endif
        <div class="clearfix"></div>
        <hr/>
    @endforeach
</div>
</body>
</html>