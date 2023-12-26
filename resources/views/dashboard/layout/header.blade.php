<?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "de";
  }
  $notifications = App\Models\Notification::where('admin_read',null)->count();
?>
<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         @if($lang == 'en')
         <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="ms-1 me-1 d-none d-md-inline-block">English</span>
        @else
          <i class="flag-icon flag-icon-de mt-1" title="de"></i> <span class="ms-1 me-1 d-none d-md-inline-block">German</span>
        @endif
        </a>
        @if ($lang == 'en')
        <div class="dropdown-menu"  @if($lang == 'en'||$lang == 'de') style="left: -110px;"@endif aria-labelledby="languageDropdown">
          <a href="/change-language/en" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> English </span></a>
          <a href="/change-language/de" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de" id="de"></i> <span class="ms-1"> German </span></a>
        </div>
        @else
        <div class="dropdown-menu"  @if($lang == 'en'||$lang == 'de') style="left: -110px;"@endif aria-labelledby="languageDropdown">
          <a href="/change-language/en" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> English </span></a>
          <a href="/change-language/de" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de" id="de"></i> <span class="ms-1"> German </span></a>
        </div>
        @endif
      </li>
      <input type="hidden" id="not_count" name="not_count" value="{{$notifications}}">
      <li class="nav-item dropdown-notifications">
        <a class="nav-link dropdown-toggle" href="/admin/notifications" role="button"   aria-haspopup="true" aria-expanded="false">
          <i data-feather="bell"></i>
        </a>
        (<span class="notif-count">{{$notifications}}</span>)
      </li>
    </ul>
  </div>
</nav>


@push('plugin-scripts')
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script type="text/javascript">
    var notificationsWrapper   = $('.dropdown-notifications');
    // var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    // var notificationsCountElem = notificationsToggle.find('i[data-count]');
    // console.log(document.getElementById('not_count').value);
    var notificationsCount     =parseInt(document.getElementById('not_count').value) ;
    // console.log(notificationsCount);
    // var notifications          = notificationsWrapper.find('ul.dropdown-menu');

    // if (notificationsCount <= 0) {
    //   notificationsWrapper.hide();
    // }

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true; CLUSTER=eu

      Pusher.logToConsole = true;

      var pusher = new Pusher('522bf2aa146e88d13776', {
          cluster: 'eu'
      });

    // Subscribe to the channel we specified in our Laravel Event
      var channel = pusher.subscribe('ample-farm-155');
      //     channel.bind('status-liked', function(data) {
      //     alert(JSON.stringify(data));
      //     });
    // Bind a function to a Event (the full Laravel class)
    channel.bind('status-liked', function(data) {
      // var existingNotifications = notifications.html();
      // var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
      // var newNotificationHtml = `
      //   <li class="notification active">
      //       <div class="media">
      //         <div class="media-left">
      //           <div class="media-object">
      //             <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
      //           </div>
      //         </div>
      //         <div class="media-body">
      //           <strong class="notification-title">`+data.message+`</strong>
      //           <!--p class="notification-desc">Extra description can go here</p-->
      //           <div class="notification-meta">
      //             <small class="timestamp">about a minute ago</small>
      //           </div>
      //         </div>
      //       </div>
      //   </li>
      // `;
      // notifications.html(newNotificationHtml + existingNotifications);
      notificationsCount += 1;
      // notificationsCountElem.attr('data-count', notificationsCount);
      notificationsWrapper.find('.notif-count').text(notificationsCount);
      notificationsWrapper.show();
    });
  </script>
@endpush