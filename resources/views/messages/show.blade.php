@extends('layouts.auth')

@section('title', trans('Message Detail'))

@section('content')

    @php
        $studentId = !empty($data) ? $data[0]['student']['id'] : null;
    @endphp

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a href="{{ route('messages.index') }}">{{ trans('Messages') }}</a> > {{ trans('Message Detail') }}</h1>
    </div>
    <!-- Content Row -->
    <div class="row">

    <div class="col-md-8 order-2 order-md-1">
        <div class="chat-container pt-3">
                <div class="messages-container" id="messagesContainer">
                    @foreach($data as $message)
                        <div class="message {{ $message["sender"] == 'school' ? 'user' : 'other' }}">
                            <div class="text">{{ $message["message"] }}</div>
                            <div class="meta">
                                {{ $message["created_at"] }}
                                @if($message["read_at"])
                                    <i class="fas fa-check-double"></i>
                                @else
                                    <i class="fas fa-check"></i>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <form action="{{ route('messages.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $studentId }}">
                <div class="input-container">
                    <textarea id="messageInput" name="message" placeholder="{{ trans('Type a message') }}..." rows="2"></textarea>
                    <button id="sendButton">{{ trans('Send') }}</button>
                </div>
                </form>
            </div>

    </div>
    <div class="col-md-4 order-1 order-md-2 pb-3">
        @if(isset($data[0]))
            <div class="row">
                <div class="col-4">{{ trans('Student') }}</div>
                <div class="col-8 h5 font-weight-bold">{{ $data[0]['student']['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4">{{ trans('Parent') }}</div>
                <div class="col-8 h5 font-weight-bold">{{ $data[0]['parent']['name'] }}</div>
            </div>
        @endif
    </div>


    <style>
        .chat-container {
            /*max-width: 600px;*/
            margin: auto;
            background: #f8f9fa;
            /*border-radius: 10px;*/
            display: flex;
            flex-direction: column;
            height: 75vh;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }
        .message {
            padding: 10px 10px 20px 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            width: fit-content;
            min-width: 200px;
            position: relative;
        }
        .message.user {
            background: #dcf8c6;
            text-align: right;
            margin-left: auto;
        }
        .message.other {
            background: #fff;
            text-align: left;
            margin-right: auto;
        }
        .message .text {
            display: inline-block;
            max-width: 80%;
        }
        .message .meta {
            font-size: 0.7em;
            color: #aaa;
            position: absolute;
            bottom: 5px;
            right: 10px;
            font-style: italic;
        }
        .input-container {
            display: flex;
            padding: 10px;
            background: #fff;
        }
        .input-container textarea {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .input-container button {
            margin: 20px 10px;
            padding: 10px 20px;
            background: #007bff;
            border: none;
            color: #fff;
            border-radius: 10px;
        }
    </style>

    <script>
            $(document).ready(function() {
                var messagesContainer = $('#messagesContainer');
                messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
            });
        </script>

@endsection



