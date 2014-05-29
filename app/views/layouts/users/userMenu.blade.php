<div id="meniu">
    <b> Username:</b> {{Auth::user()->username}}<br>
    <b>Email:</b> {{Auth::user()->email}}<br> 
    <b>BirthDate:</b> {{Auth::user()->birthdate}}
    <hr>
    <?php $id = Auth::user()->id; ?>
    <ul id="accordion">
        <li><div><a href="#">USER DETAILS</a></div></li>
        <ul>
            <li><a href="{{ url('user/edit/'.$id) }}">Edit Profile</a></li>
            <li><a href="{{ url('user/newpassword') }}">Change Password</a></li>
            <?php if (Auth::user()->visible) { ?> 
                <li><a href="{{ url('user/visibleoff/'.$id) }}">Turn Off Visibility</a></li>
            <?php } else { ?>
                <li><a href="{{ url('user/visibleon/'.$id) }}">Turn On Visibility</a></li>
            <?php } ?>
        </ul>
        <li><div><a href="{{ url('message/create') }}">CREATE MESSAGE</a></div></li>
        <li><div><a href="#">INBOX</a></div></li>
        <ul>
            <li><a href="{{ url('message/unread') }}">Unread Message(s)</a></li>
            <li><a href="{{ url('message/inbox') }}">All Inbox Messages</a></li>
        </ul>
        <li><div><a href="{{ url('message/sent') }}">SENT MESSAGES</a></div></li>
        <li><div><a href="#">USERS LIST</a></div></li>
        <ul>
            <li><a href="{{ url('user/visible') }}">Visible Users</a></li>
        </ul>
        <li><div><a href="{{ url('user/birthdayusers') }}">BIRTHDAY USERS</a></div></li>
        <li><div><a href="{{ url('user/delete/'.$id) }}">DELETE ACCOUNT</a></div></li>
        <li><div><a href="{{ url('user/logout') }}">LOGOUT</a></div></li>
    </ul>
</div>