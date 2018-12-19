<div style="margin:0px 50px 0px 50px;">

    @if($services)
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>№ п/п</th>
                <th>Название</th>
                <th>Текст</th>
                <th>Иконка</th>
                <th>Спец слова</th>
                <th>Дата создания</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>

            @foreach($services as $key => $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{!! Html::link(route('serviceEdit',['service'=>$service->id]),$service->name,['alt'=>$service->name]) !!}</td>
                    <td>{{ $service->text }}</td>
                    <td>
                        <div class="service_block">
                            <div class="service_icon delay-03s animated wow  zoomIn"><i
                                            class="fa {{$service->icon}}"></i></div>
                        </div>
                    </td>
                    <td>{{ $service->icon }}</td>
                    <td>{{ $service->created_at }}</td>
                    <td>
                        {!! Form::open(['url'=>route('serviceEdit',['service'=>$service->id]), 'class'=>'form-horizontal','method' => 'POST']) !!}
                        {!! Form::hidden('_method', 'delete') !!}
                        {{--{{method_field('DELETE')}}--}}
                        {!! Form::button('Удалить',['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif

    {!! Html::link(route('serviceAdd'),'Новый сервис') !!}
</div>