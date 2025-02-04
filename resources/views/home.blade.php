<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @auth
        <p>Congrats you are login</p>
        <form action="/logout" method="POST">
            @csrf
            <button>logout</button>
        </form>


        <div style="border: 3px solid black">
            <h2>Register</h2>

            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" placeholder="body content ..."></textarea>
                <button>Save Post</button>
            </form>
        </div>    
        <div style="border: 3px solid black">
            <h2>All Posts</h2>
            @foreach ( $posts as $post )
                <div style="background-color: gray; padding: 10px; margin: 10px;">
                    <h3>{{$post['title']}}  by {{$post->user->name}}</h3>
                    {{$post['body']}}

                    <p><a href="/edit-post/{{$post->id}}">edit</a></p>

                    <form action="/delete-post/{{$post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button style="background-color: red">delete</button>
                    </form>
                </div>
            @endforeach
        </div>    

        @else
        <div style="border: 3px solid black">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input type="text" name="name" placeholder="name">
                <input type="email" name="email" id=""  placeholder="email">
                <input type="password" name="password" id="" placeholder="password">
                <button>Register</button>
            </form>
            
        </div>
        <div style="border: 3px solid black">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input type="text" name="loginname" placeholder="name">
                <input type="password" name="loginpassword" id="" placeholder="password">
                <button>login</button>
            </form>
            
        </div>
    @endauth
</body>
</html>


