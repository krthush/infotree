@extends('layouts.app')

@section('content')

<div class="container">
    <div class="well well-sm">
        <div class="form-group">
            <div class="input-group input-group-md">
                <div class="icon-addon addon-md">
                    <input type="text" placeholder="What are you looking for?" class="form-control" v-model="query">
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" @click="search()" v-if="!loading">Search!</button>
                    <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                </span>
            </div>
        </div>
    </div>
    <div class="alert alert-danger" role="alert" v-if="error">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        @{{ error }}
    </div>
    <div id="leaves" class="row list-group">
        <div class="item col-xs-4 col-lg-4" v-for="leaf in leaves">
            <div class="thumbnail">
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">@{{ leaf.title }}</h4>
                    <p class="group inner list-group-item-text">@{{ leaf.link }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection