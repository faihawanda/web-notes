<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;600&family=Lexend+Mega:wght@700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Lexend Deca', sans-serif;
            background:#E9DED6;
        }

        /* FULL CANVAS (NO CARD LOOK) */
        .page{
            min-height:100vh;
            display:flex;
        }

        .left{
            width:65%;
            background:#E9DED6;
            padding:80px 70px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .right{
            width:35%;
            background:#FF4A00;
            position:relative;
            display:flex;
            align-items:flex-end;
            justify-content:center;
            padding:50px;
        }

        /* ================= LEFT ================= */

        .welcome{
            border:1px solid #111;
            padding:10px 28px;
            border-radius:999px;
            font-size:64px;
            width:fit-content;
            margin-bottom:16px;
        }

        .row{
            display:flex;
            align-items:center;
            gap:16px;
            margin-bottom:20px;
        }
       .back{
           background:#000;
           color:#1E33FF;
          font-family:'Lexend Deca', sans-serif;
          font-size:64px;
          padding:10px 28px;
           border-radius:999px;
}

        .to{
            font-size:64px;
            display:flex;
            gap:10px;
            align-items:center;
        }

        .to span{
            color:#FF4A00;
        }

        .desc{
            max-width:520px;
            font-size:18px;
            margin-bottom:28px;
            color:#222;
        }

       .input{
         width:100%;
         height:60px;
         border:1.5px solid #222;
         border-radius:999px;
         padding:0 20px;
         margin-bottom:12px;
         background:#E9DED6;
        overflow:hidden;
            }

        .input input{
            width:100%;
            height:100%;
            border:none;
            outline:none;
            background:#E9DED6;
            font-size:16px;
            font-family:'Lexend Deca', sans-serif;
        }

            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus{
            -webkit-box-shadow:0 0 0 1000px #E9DED6 inset !important;
            -webkit-text-fill-color:#000 !important;
            border:none !important;
    }

        button{
            width:100%;
            height:60px;
            border:none;
            border-radius:999px;
            background:#2B35FF;
            color:#fff;
            font-size:18px;
            margin-top:10px;
            cursor:pointer;
        }

        .bottom{
            display:flex;
            justify-content:space-between;
            margin-top:12px;
            font-size:14px;
        }

        /* ================= RIGHT ================= */

        .cupcakes{
            position:absolute;
            top:60px;
            left:50%;
            transform:translateX(-50%);
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:26px;
        }

        .cupcakes img{
            width:60px;
            height:60px;
            object-fit:contain;
        }

        .brand{
            text-align:center;
            color:#fff;
        }

        .brand h3{
            font-size:28px;
        }

.brand h1{
    font-size:150px;
    line-height:1;
    font-family:'Lexend Mega', sans-serif;
    font-weight:700;
    letter-spacing:16px;
}

/* CHROME INPUT FIX */
input{
    -webkit-appearance:none;
    appearance:none;
    font-family:'Lexend Deca', sans-serif;
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus{
    -webkit-box-shadow:0 0 0 1000px #E9DED6 inset !important;
    -webkit-text-fill-color:#000 !important;
}

/* ================= MOBILE ================= */

@media(max-width:900px){

    .page{
        flex-direction:column;
    }

    .left{
        width:100%;
        padding:40px 20px;
    }

    .right{
        display:none;
    }

    .welcome,
    .back,
    .to{
        font-size:40px;
    }
}

    </style>
</head>

<body>

<div class="page">

    {{-- LEFT --}}
    <div class="left">

        <div class="welcome">Welcome</div>

        <div class="row">
            <div class="back">Back</div>

            <div class="to">
                <span>(</span>
                To
                <span>)</span>
            </div>
        </div>

        <div class="desc">
            Sign in to your account and keep creating, connecting, growing.
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input">
                <input type="email" name="email" placeholder="Email">
            </div>

            <div class="input">
                <input type="password" name="password" placeholder="Password">
            </div>

            <button>Sign In</button>

            <div class="bottom">
                <label><input type="checkbox"> Remember</label>
                <a href="#">Forgot?</a>
            </div>

        </form>

    </div>

    {{-- RIGHT --}}
    <div class="right">

        {{-- <div class="cupcakes">
            @for($i=0;$i<6;$i++)
                <img src="{{ asset('assets/images/cupcake.png') }}">
            @endfor
        </div> --}}

        <div class="brand">
            <h3>We Are</h3>
            <h1>PAY</h1>
        </div>

    </div>

</div>

</body>
</html>