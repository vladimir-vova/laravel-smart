@extends('admin.layouts.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Письмо</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body p-0">
                                <div class="mailbox-read-info">
                                    <h5>Тема: {{ $message->subject }}</h5>
                                    <h6>Имя: {{ $message->name }}; Почта: {{ $message->email }}
                                        <span class="mailbox-read-time float-right">15 Feb. 2015 11:03 PM</span>
                                    </h6>
                                </div>
                                <!-- /.mailbox-controls -->
                                <div class="mailbox-read-message">
                                    @if($message->message == null)
                                    Сообщения нет...
                                    @else
                                    {{ $message->message }}
                                    @endif
                                </div>
                                <!-- /.mailbox-read-message -->
                            </div>
                            <!-- /.card-footer -->
                            <div class="card-footer">
                                <form action="{{ route('message.destroy',['message'=>$message->id]) }}" method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection