@foreach ($users as $user)
<tr id="user_id_{{ $user->id }}">
    <td>{{ $loop->index +1 }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td><button id="edit-user" data-id="{{ $user->id }}"
            class="btn btn-primary">Edit</button></td>
    <td><button id="delete-user" data-id="{{ $user->id }}"
            class="btn btn-danger">Delete</button>
    <td><button id="show-pruduct" data-id="{{ $user->id }}"
            class="btn btn-primary">Show product</button></td>
</tr>
@endforeach