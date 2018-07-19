<div class="serviceWrapContent container">

    @if($data)

        <h3>Список действующих услуг</h3>

        @foreach($data as $k => $value)

            <div class="servicesItem">
                <div class="serviceInWrap">
                <div class="serviceItemNum col-xs-1">{{ $value['id'] }}</div>
                <div class="serviceItemName col-xs-3"><a href="{{route('servicesEdit',[$value['id']])}}">{{ $value['name'] }}</a></div>
                <div class="serviceItemText col-xs-6">{{ $value['text'] }}</div>
                <div class="serviceItemDel col-xs-2">
                    {!! Form::open(['url'=>route('servicesEdit',['service'=>$value['id']]), 'class'=>'form-horizontal','method' => 'POST']) !!}
                    {{ method_field('DELETE') }}
                    {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
            </div>

        @endforeach

    @else
        {!!  '<h2>Пока у вас нет услуг...</h2>' !!}
    @endif

        {!! Html::link(route('servicesAdd'),'Создать новую услугу') !!}
    </div>
