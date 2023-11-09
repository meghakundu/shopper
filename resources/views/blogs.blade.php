@extends('layouts.app-master')
@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
 @endif
 @if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}
</div>
 @endif
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Published At</th>
                <th>Reading Time</th>
                <th>Social Media Share</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogsList as $blog_item)
            <tr>
                <td><a href="{{$blog_item['post_link']}}">{{$blog_item['name']}}</a></td>
                <td>{{date('d M,y',strtotime($blog_item['created_at']))}}</td>
                <td>{{$blog_item['reading_time']}}</td>
               <td>
                @if($blogs_per_month->count()>1)
               <a href="/share-posts/{{$blog_item['id']}}"><button>Publish Later</button></a>
                @endif
               <div id="blogs-share"> {!! Share::page(url($blog_item['post_link']))->facebook() !!}</div>
              </td>   
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
