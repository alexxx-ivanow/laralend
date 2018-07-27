<div class="serviceWrapContent container">

    @if($value)

        <h3>Список фото для портфолио</h3>

        <div class="servicesItem">
            <div class="serviceInWrap" style="color: green">

                <div class="serviceItemName col-xs-4"><h4>Фото</h4></div>
                <div class="serviceItemNum col-xs-3"><h4>Название</h4></div>
                <div class="serviceItemText col-xs-5"><h4>Категория фото</h4></div>
            </div>
        </div>


        @foreach($value as $k => $item)

            <div class="servicesItem">
                <div class="serviceInWrap">

                    <div class="serviceItemNum col-xs-4">
                        @if (!empty($item['images']))

                            <div class="img-portfolio">
                                {!! Html::image('assets/img/'.$item['images'], 'Фото для портфолио', ['class' => 'imgP']) !!}
                            </div>

                        @endif

                     </div>
                    <div class="serviceItemName col-xs-3"><a href="{{route('portfolioEdit',[$item['id']])}}">{{ $item['name'] }}</a></div>
                    <div class="serviceItemText col-xs-3">{!! $item['filter'] !!}</div>
                    <div class="serviceItemDel col-xs-2">
                        {!! Form::open(['url'=>route('portfolioEdit',['portfolio'=>$item['id']]), 'class'=>'form-horizontal','method' => 'POST']) !!}
                        {!! Form::hidden('id', $item['id']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить',['class'=>'btn btn-danger portDel','type'=>'submit']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach

    @else
        {!!  '<h2>Пока у вас нет услуг...</h2>' !!}
    @endif

    {!! Html::link(route('portfolioAdd'),'Добавить новое фото в портфолио') !!}
</div>

