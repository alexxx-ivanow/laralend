<div class="wrapper container-fluid">

    @if($data)

        <h3 style="text-align: center; margin: 0 0 30px">Внесите коррективы в данные портфолио</h3>

        {!! Form::open(['url' => route('portfolioEdit', ['portfolio' => $data->id]),'class'=>'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group">

            {!! Form::label('name','Название',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('name',$data->name,['class' => 'form-control','placeholder'=>'Введите название фото'])!!}
            </div>

        </div>

        <div class="form-group">

            {!! Form::label('filter','Категория',['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('filter',$data->filter,['class' => 'form-control','placeholder'=>'Введите категорию фото'])!!}
            </div>

        </div>

        <div class="form-group">
           <div class="col-xs-2"></div>
            <div class="col-xs-8">
                {!! Html::image('assets/img/'.$data->images, 'Фото для портфолио', ['style' => 'width:300px']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('images', 'Новое изображение:',['class'=>'col-xs-2 control-label']) !!}
            <div class="col-xs-8">
                {!! Form::file('images', ['class' => 'filestyle','data-buttonText'=>'Выберите новое изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                {!! Form::button('Сохранить изменения', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
        </div>

        {!! Form::close() !!}

    @endif

</div>