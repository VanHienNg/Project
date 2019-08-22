//Post ajax
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    //Btn Add post click
    $('#create-new-post').click(function () {
        var validator = $ ('#postForm').validate(); 
        validator.resetForm(); 
        $('#postForm').trigger("reset");
        $('#btn-post').val('create-post');
        $('#delete-paragraph').hide();
        $('#postCrudModal').html('Create new Post');
        $('#ajax-post-modal').modal('show');
    });

    //Btn click on post paragraph
    $('body').on('click', '#post-paragraph', function () {
        var validator = $('#postForm'). validate(); 
        validator.resetForm(); 
        $('#postForm').trigger("reset");
        var post_id = $(this).data('id');
        $.get('post/' + post_id + '/edit', function (data) {
            $('#ajax-post-modal').modal('show');
            $('#postCrudModal').html('Edit Post');
            $('#btn-post').val("edit-post");
            $('#delete-paragraph').show();
            $('#postId').val(data.id);
            $('#title').val(data.title);
            $('#slug').val(data.slug);
            $('#body').val(data.body);
        })
    });

    //Btn delete
    $('body').on('click', '#delete-post', function () {
        var post_id = $(this).data('id');
        var choise = confirm("Are your sure want to delete?");
        if (choise) {
            $.ajax({
                type: "DELETE",
                url: "/post" + '/' + post_id,
                success: function (data) {
                    // $("#post_id_" + post_id).remove();
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            $('#ajax-post-modal').modal('hide');
        }
    });

    //Live search post
    $('#search-post').on('keyup', function () {
        var value = $(this).val();
        var user_id = $('.post-item').data("id");
        if(value == '') {
            window.location.reload();
        } else {
            if(user_id != undefined) {
                $.ajax({
                    type: 'post',
                    url: "/post/search",
                    data: {
                        'search': value,
                        'user_id': user_id
                    },
                    success: function (data) {
                        $('#post-latest').html(data.html);
                    }
                });
            }
        };
    })
});

//Save post function
$(function () {
    $('#postForm').validate({
        submitHandler: function (form) {
            var actionType = $('#btn-post').val();
            $.ajax({
                data: $('#postForm').serialize(),
                url: "/post",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    var post =     '<div class="col-xl-4 col-md-6 mb-4" id="post_id_' + data.id + '">';
                    post +=           '<div class="card border-left-primary shadow h-100 py-2">';
                    post +=             '<div class="card-body">';
                    post +=                 '<div class="row no-gutters align-items-center">';
                    post +=                     '<div class="col-12 mr-2" id="post-paragraph" data-id="' + data.id + '">';
                    post +=                         '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">' + data.title + '</div>';
                    post +=                             '<textarea class="h6 mb-0" readonly style="border: none;overflow: hidden;box-shadow: none">' + data.body + '</textarea>';
                    post +=                         '</div>'
                    post +=                     '</div>'
                    post +=                     '<div class="col-12">'
                    post +=                         '<button class="btn btn-danger" style="font-size:12px" id="delete-post" data-id="' + data.id + '">Delete</button>';
                    post +=                     '</div>'
                    post +=                 '</div>'
                    post +=             '</div>'
                    post +=         '</div>'

                    if (actionType == "create-post") {
                        $('#post-latest').prepend(post);
                    } else {
                        $("#post_id_" + data.id).replaceWith(post);
                    }

                    $('#ajax-post-modal').modal('hide');
                    $('#btn-post').html('Save changes');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#btn-post').html('Save changes');
                }
            });
        }
    })
});


//Admin ajax 
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    //Add btn onclick
    $('#create-new-user').click(function () {
        var validator = $('#userForm').validate(); 
        validator.resetForm(); 
        $('.error-alert').remove();
        $('#btn-save').val("create-user");
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Add New User");
        $('#ajax-crud-modal').modal('show');
    });

    //Edit btn onclick
    $('body').on('click', '#edit-user', function () {
        var validator = $('#userForm').validate(); 
        validator.resetForm(); 
        var user_id = $(this).data('id');
        console.log(user_id);
        $.get('admin/' + user_id + '/edit', function (data) {
            $('#ajax-crud-modal').modal('show');
            $('#userCrudModal').html("Edit User");
            $('#btn-save').val("edit-user");
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').val(data.password);
        })
    });

    //Delete btn onclick + delete DB function
    $('body').on('click', '#delete-user', function () {
        var user_id = $(this).data("id");
        var choise = confirm("Delete this user will delete all their post. Are you sure want to delete?");

        if (choise) {
            $.ajax({
                type: "DELETE",
                url: "/admin" + '/' + user_id,
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        } else {
            $('#userForm').trigger('reset');
        }
    });

    //Live search user
    $('#search-user').on('keyup', function () {
        var value = $(this).val();
        if(value == '') {
            window.location.reload();
        };
        $.ajax({
            type: 'post',
            url: "/admin/search",
            data: {
                'search': value
            },
            success: function(data) {
                $('#users-latest').html(data.html);
            }
        });
    });

    //Show post btn
    $('body').on('click', '#show-post', function() {
        var user_id = $(this).data("id");
        $.ajax({
            type: 'post',
            url: '/admin/show',
            data: {
                'id': user_id
            },
            success: function(data) {
                $('#admin-content').html(data.html);
                $('#back-user-bar').show();
                $('#search-form-user').hide();
            }
        });
    });

    $('body').on('click', '#back-user-list', function() {
        window.location.reload();
    });
});

//Save btn function
$(function () {
    $("#userForm").validate({
        submitHandler: function (form) {
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            $.ajax({
                data: $('#userForm').serialize(),
                url: "/admin",
                type: "post",
                dataType: 'json',
                success: function (data) {
                    var user = '<tr id="user_id_' + data.id + '"><td>1</td><td>' + data.name + '</td><td>' + data.email + '</td>';
                    user += '<td><button id="edit-user" data-id="' + data.id + '" class="btn btn-primary">Edit</button></td>';
                    user += '<td><button id="delete-user" data-id="' + data.id + '" class="btn btn-danger">Delete</button></td>';
                    user += '<td><button id="show-post" data-id="' + data.id + '" class="btn btn-primary">Show Product</button></td></tr>';

                    if (actionType == "create-user") {
                        $('#users-latest').prepend(user);
                        window.location.reload();
                    } else {
                        $("#user_id_" + data.id).replaceWith(user);
                    }

                    $('#userForm').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        }
    })
});

//Index view ajax
$(document).ready(function() {
    //Search post
    $('#search-post-list').on('keyup', function () {
        var value = $(this).val();
        if(value == '') {
            window.location.reload();
        };
        $.ajax({
            type: 'post',
            url: "/index/search",
            data: {
                'search': value
            },
            success: function (data) {
                $('#post-list').html(data.html);
            }
        });
    });

    //Feedback btn
    $('.feedback-btn').click(function() {
        var fb = $(this).val();
        var post_id = $(this).data("id");
        $.ajax({
            type: 'post',
            url: "/index/store",
            data: {
                'feedback': fb,
                'post_id': post_id
            },
            success: function () {
                if(fb == 0) {
                    var val = $('#dislike-'+post_id).attr('value');
                    val++;
                    var btn = '<label class="fb-value" id="dislike-'+post_id+'" for="dislike-btn" value="'+val+'">'+val+'</label>';
                    $('#dislike-'+post_id).replaceWith(btn);
                } else {
                    var val = $('#like-'+post_id).attr('value');
                    val++;
                    var btn = '<label class="fb-value" id="like-'+post_id+'" for="like-btn" value="'+val+'">'+val+'</label>';
                    $('#like-'+post_id).replaceWith(btn);
                }
            }
        });
        
    });
});
