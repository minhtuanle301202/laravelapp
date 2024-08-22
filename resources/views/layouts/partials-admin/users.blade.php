<table class="table table-bordered">
    <thead>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Ngày tạo</th>
        <th>Cập nhật</th>
        <th>Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            <td>
                <div class="option">
                    <button class="btn btn-info btn-sm btn-edit" data-id="{{ $user->id }}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}"><i class="fas fa-trash-alt"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
