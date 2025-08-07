@extends('user-side.layouts.app')

@section('title', 'Chat Debug')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Chat System Debug</h4>
                </div>
                <div class="card-body">
                    <h5>Current User: {{ auth()->user()->name }} (ID: {{ auth()->id() }})</h5>
                    
                    <hr>
                    
                    <h6>User's Exchanges:</h6>
                    @php
                        $userExchanges = \App\Models\Exchange::where(function($query) {
                            $query->where('initiator_id', auth()->id())
                                  ->orWhere('participant_id', auth()->id());
                        })->whereIn('status', ['pending', 'in_progress', 'completed'])
                        ->with(['initiator', 'participant', 'initiatorSkill', 'participantSkill'])
                        ->get();
                    @endphp
                    
                    @if($userExchanges->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Initiator</th>
                                        <th>Participant</th>
                                        <th>Messages</th>
                                        <th>Unread</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userExchanges as $exchange)
                                        @php
                                            $otherUser = $exchange->initiator_id === auth()->id() ? $exchange->participant : $exchange->initiator;
                                            $messageCount = \App\Models\Message::where('exchange_id', $exchange->id)->count();
                                            $unreadCount = \App\Models\Message::where('exchange_id', $exchange->id)
                                                ->where('receiver_id', auth()->id())
                                                ->where('is_read', false)
                                                ->count();
                                        @endphp
                                        <tr>
                                            <td>{{ $exchange->id }}</td>
                                            <td>{{ $exchange->title }}</td>
                                            <td><span class="badge badge-{{ $exchange->status === 'pending' ? 'warning' : ($exchange->status === 'in_progress' ? 'info' : 'success') }}">{{ $exchange->status }}</span></td>
                                            <td>{{ $exchange->initiator->name }}</td>
                                            <td>{{ $exchange->participant ? $exchange->participant->name : 'None' }}</td>
                                            <td>{{ $messageCount }}</td>
                                            <td>{{ $unreadCount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No exchanges found for this user.</p>
                    @endif
                    
                    <hr>
                    
                    <h6>Recent Messages:</h6>
                    @php
                        $recentMessages = \App\Models\Message::where('receiver_id', auth()->id())
                            ->orWhere('sender_id', auth()->id())
                            ->with(['sender', 'exchange'])
                            ->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get();
                    @endphp
                    
                    @if($recentMessages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Exchange</th>
                                        <th>Sender</th>
                                        <th>Message</th>
                                        <th>Time</th>
                                        <th>Read</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentMessages as $message)
                                        <tr>
                                            <td>{{ $message->id }}</td>
                                            <td>{{ $message->exchange->title }}</td>
                                            <td>{{ $message->sender->name }}</td>
                                            <td>{{ Str::limit($message->message, 50) }}</td>
                                            <td>{{ $message->created_at->diffForHumans() }}</td>
                                            <td>{{ $message->is_read ? 'Yes' : 'No' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No messages found.</p>
                    @endif
                    
                    <hr>
                    
                    <h6>API Test Links:</h6>
                    <div class="btn-group">
                        <a href="{{ route('user.chat.exchanges') }}" class="btn btn-primary" target="_blank">Test Exchange Chats API</a>
                        <a href="{{ route('user.chat.unread') }}" class="btn btn-info" target="_blank">Test Unread Count API</a>
                        <a href="{{ route('user.chat.recent') }}" class="btn btn-success" target="_blank">Test Recent Messages API</a>
                    </div>
                    
                    <hr>
                    
                    <h6>Go to Chat:</h6>
                    <a href="{{ route('user.chat') }}" class="btn btn-lg btn-success">Open Chat Interface</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 