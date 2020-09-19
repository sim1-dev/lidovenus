@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')

@include('layouts.alert')




<label>
    Search number order
    <form id="search" action="{{ route('order.show','') }}" onsubmit="$().showorder();">
        <input class="form-control form-control-sm" id="ordernumber" placeholder="Enter for search">
    </form>
</label>
<table id="tableorders" class="table table-bordered table-hover dataTable table-striped" style="text-align: center;background-color: #fff">
    <thead>
        <tr role="row" style="width: 100%">
            <th id="colonna1" style="width:5%;">ID</th>
            <th id="colonna1" style="width:5%;">ID Utente</th>
            <th id="colonna2" style="width:10%;">ID Ombrellone</th>
            <th id="colonna2" style="width:45%;">Products</th>
            <th id="colonna3" style="width:10%;">Quantità</th>
            <th id="colonna4" style="width:10%;">Prezzo</th>
            <th id="timestamp" style="width: 10%;" class="header headerSortDown">Data</th>
            <th id="action" style="width:5%;">Azioni</th>
        </tr>
    </thead>
    <tbody>


      <ul>


        @foreach ($orders as $element)

        <tr role="row">


                <td>{{ $element->id }}</td>
            <td>
                @php
                $idorder = \App\Order::find($element->id);
                @endphp
                @foreach ($idorder->users as $elements)
                {{ $elements->id }}
                @endforeach
            </td>
            <td>
                @foreach ($idorder->umbrellas as $elementss)
                {{ $elementss->id }}
                @endforeach
            </td>

            <td>
                @php
                $items = json_decode($element->id_products);
                $productNumber = 0;
                $totalOrder = 0;
                foreach ($items as $key => $value) {
                    $productNumber++;
                    $totalOrder += $value->quantity * $value->price;
                    echo $value->name."("."<strong>".$value->quantity."</strong>".")".'&ensp;';
                }
                @endphp
            </td>
            <td style="border: 1px solid #819AD4; text-align: center;">{{ $productNumber }}</td>
            <td>{{ $totalOrder }} €</td>@php @endphp
            <td>{{ $element->created_at }} </td>
            <td class="text-center"><a style="display:inline;float:left" href="{{ route('order.show',$element->id) }}"><img width="20px" height="20px" src="{{ asset('img/search.png') }}"></a>

                <form style="display:inline;float:right" action="{{ route('order.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="idorder" value="{{ $element->id }}">
                    <input class="ordercompleted" type="image" src="{{ asset('img/tick.png') }}" width="20" height="20">
                </form>
            </td>
        </tr>
        @endforeach

</tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $orders->links() }}
</div>

<div class="d-flex justify-content-center">
    <a href="{{ route('order.index') }}" class="btn btn-primary popup-trigger w-100">Risolvi ordini</a>
</div>

    @stop

    @section('css')

    <style type="text/css">
        .popup-trigger {
            display: block;
            margin: 0 auto;
            padding: 20px;
            max-width: 260px;
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            line-height: 24px;
            cursor: pointer;
        }
        .popup {
            display: none;
            position: absolute;
            top: 100px; left: 50%;
            width: 700px;
            margin-left: -350px;
            padding: 50px 30px;
            background: #fff;
            color: #333;
            font-size: 19px;
            line-height: 30px;
            border: 1px solid #000;
            z-index: 9999;
        }
        .popup-mobile {
            position: relative;
            top: 0; left: 0;
            margin: 30px 0 0;
            width: 100%;
        }
        .popup-btn-close {
            position: absolute;
            top: 8px; right: 14px;
            color: #4EBD79;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
        }
        .popup-btn-compleate {
            position: absolute;
            bottom: 5px; right: 14px;
            color: #4EBD79;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
        }
    </style>

    <link rel="stylesheet" href="/css/admin_custom.css">

    <style type="text/css">
        th.headerSortUp{

            background-image: url('/img/up-arrow.png');
            background-color: #819AD4;
            background-repeat: no-repeat;
            background-position: center right;
        }

        th.headerSortDown{
            background-image: url('/img/down-arrow.png');
            background-color: #819AD4;
            background-repeat: no-repeat;
            background-position: center right;
        }




        .pagination>li>a, .pagination>li>span {
            color: #1a0000;
            border: 1px solid #000;
        }

        .pagination>li>a:hover,
        .pagination>li>span:hover,
        .pagination>li>a:focus,
        .pagination>li>span:focus {
            color: #000;
            background-color: transparent;
            border-color: #454B54;

        }


        .page-item.active .page-link {
            /*Nel riquadro*/
            z-index: 3;
            color: #000;
            background-color: #819AD4;
            border-color: #454B54;
        }
        .page-item.disabled .page-link {
            /*Fine corsa*/
            border-color: #454B54;
            color:#000;
        }





    </style>
    @stop

    @section('js')
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> chart.js-->


    @include('construct.badgeorder')

    <script src="/js/tablesorter.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#tableorders").tablesorter();
        });

    </script>

  <script>
     $( document ).ready(function() {
      $('input').on('input', function() {
        $(this).val($(this).val().replace(/^[^1-9]/g,''));
    });
  });


</script>

<script type="text/javascript">
  $('.ordercompleted').click(function() {
    if (confirm('Close this order ?')) {
      return true;
  }
  else{
      return false;
  }
});
</script>

<script>
  var linkb = $("#search").attr("action");
  (function( $ ){
     $.fn.showorder = function() {
        var id = $("#ordernumber").val();
        $ciao = $("#search").attr("action",linkb+"/"+id);

    };
})( jQuery );

</script>
@stop




