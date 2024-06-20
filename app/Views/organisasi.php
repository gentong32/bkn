<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Horizontal Organization Chart</title>
    <style>
        .org-chart {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .node {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
        }

        .arrow {
            width: 20px;
            height: 20px;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid #ccc;
        }
    </style>
</head>

<body>

    <div id="orgChart" class="org-chart"></div>

    <script>
        var data = [{
                name: 'CEO',
                children: ['Manager1', 'Manager2']
            },
            {
                name: 'Manager1',
                children: ['Employee1', 'Employee2']
            },
            {
                name: 'Manager2',
                children: ['Employee3', 'Employee4']
            },
            {
                name: 'Employee1',
                children: []
            },
            {
                name: 'Employee2',
                children: []
            },
            {
                name: 'Employee3',
                children: []
            },
            {
                name: 'Employee4',
                children: []
            }
        ];

        function createNode(name) {
            var node = document.createElement('div');
            node.className = 'node';
            node.innerHTML = name;
            return node;
        }

        function createArrow() {
            var arrow = document.createElement('div');
            arrow.className = 'arrow';
            return arrow;
        }

        function renderChart(data) {
            var orgChart = document.getElementById('orgChart');
            data.forEach(function(item) {
                var parentNode = createNode(item.name);
                orgChart.appendChild(parentNode);
                if (item.children.length > 0) {
                    var arrow = createArrow();
                    orgChart.appendChild(arrow);
                    item.children.forEach(function(childName, index) {
                        var childNode = createNode(childName);
                        orgChart.appendChild(childNode);
                        if (index < item.children.length - 1) {
                            var arrow = createArrow();
                            orgChart.appendChild(arrow);
                        }
                    });
                }
            });
        }

        renderChart(data);
    </script>

</body>

</html>