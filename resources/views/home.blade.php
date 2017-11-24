@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('pName') ? ' has-error' : '' }}">
                            <label for="pName" class="col-md-4 control-label">Product Name</label>

                            <div class="col-md-6">
                                <input id="pName" type="text" class="form-control" name="products[pName]" value="{{ old('pNAme') }}" required autofocus>

                                @if ($errors->has('pName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quanStock') ? ' has-error' : '' }}">
                            <label for="quanStock" class="col-md-4 control-label">Quantity in stock</label>

                            <div class="col-md-6">
                                <input id="quanStock" type="number" class="form-control" name="products[quanStock]" value="{{ old('quanStock') }}" required >

                                @if ($errors->has('quanStock'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quanStock') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="products[price]" value="{{ old('price') }}" required>

                                @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Entries</div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity in stock</th>
                                <th>Price per item</th>
                                <th>Datetime submitted</th>
                                <th>Total value number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($jsonPData)>0)
                            
                                @foreach($jsonPData as $row)
                                <tr>
                                    <td>{{$row['pName']}}</td>
                                    <td>{{$row['quanStock']}}</td>
                                    <td>{{$row['price']}}</td>
                                    <td>{{$row['dt']}}</td>
                                    <td>{{$row['total']}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
