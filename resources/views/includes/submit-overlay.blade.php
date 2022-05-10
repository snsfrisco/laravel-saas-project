<style>
    #overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        opacity: 0.7;
        z-index: 9990;
        cursor: pointer;
    }

    #text{
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 50px;
      color: white;
      transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
      text-align: center;
    }
    </style>
    </head>
    <body>

    <div id="overlay" onclick="on()">
      <div id="text"><img src="{{asset('images/loading.gif')}}" alt="" style="width:25%;"/><h6 class="text-dark">Please Wait ...</h6></div>
    </div>

    {{--<div style="padding:20px">
      <button onclick="on()">Turn on overlay effect</button>
    </div> --}}

    <script>
    function on() {
      document.getElementById("overlay").style.display = "block";
    }

    function off() {
      document.getElementById("overlay").style.display = "none";
    }
    </script>
