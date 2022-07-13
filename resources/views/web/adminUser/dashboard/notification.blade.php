@if(!$notificationList->isEmpty())
<div class="col-md-12">
    <h3>Notificaciones</h3>
    <div class="box">
        <section>
            <div class="row">
                @foreach($notificationList as $notification)
                <div class="col-sm-4">
                    <ul class="features-checkboxes">
                        <li>
                            <p><em> {{ \Carbon\Carbon::parse($notification->created_at)->diffforHumans() }}</em></p>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-8">
                    <div class="adds-wrapper">

                        <div class="item-list">
                            <div class="col-sm-12 add-desc-box">
                                <div class="ads-details">
                                    <p><strong> {{ $notification->title }} </strong></p>
                                    <p><small> {{ $notification->body }}</small> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endif