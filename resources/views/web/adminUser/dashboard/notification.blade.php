@if(!$notificationList->isEmpty())
<div class="inner-box">
    <div class="col-sm-12 page-content">
        <div class="inner-box">
            <h2 class="title-2">Notificaciones </h2>

            <div class="row">
                @foreach($notificationList as $notification)
                <div class="col-sm-4">
                    <ul class="list-group list-group-unstyle">
                        <li class="list-group-item active">
                                <span> {{ \Carbon\Carbon::parse($notification->created_at)->diffforHumans() }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-8">
                    <div class="adds-wrapper">
                        
                        <div class="item-list">
                            <div class="col-sm-12 add-desc-box">
                                <div class="ads-details">
                                    <h5 class="add-title"><a href="#"> {{ $notification->title }} </a>
                                    </h5>
                                    <span class="info-row"> {{ $notification->body }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif