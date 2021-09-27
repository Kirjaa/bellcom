<div class="w-100">
    <div class="panel panel-default">
        <div class="panel-body" id="response-block">
            <table class="table table-bordered table-hover w-100"><thead>
                <tr>
                    <th>Agenda type</th>
                    <th>Name</th>
                    <th>Sysid</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                    <td>{{ $xmlFile['type_name']}}</td>
                    <td>{{ $xmlFile['name'] }}</td>
                    <td>{{ $xmlFile['sysid'] }}</td>
                    <td>{{ $xmlFile['date'] }}</td>
                </tbody>
            </table>
        </div>
    </div>
</div>
