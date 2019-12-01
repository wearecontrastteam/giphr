@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white p-4">
                <div class="row">
                    <div class="col-8">
                        <h1 class="mb-4">Welcome to Giphr!</h1>
                        <h4 class="mb-4">The social network focused on the best form of communication, GIFs!</h4>
                    </div>
                    <div class="col-4">
                        <img src="/img/logo-lg.png" alt="Giphr" width="100%">
                    </div>
                </div>
            </div>

            <div class="col-12 bg-white p-4">
                <h5>We've all been there</h5>

                <p>
                    <img src="https://media.giphy.com/media/fQZX2aoRC1Tqw/giphy.gif" alt="typing typing typing" style="width: 480px; height: 270px; left: 0px; top: 0px;">
                </p>

                <p>
                    Someone sends you a 15 tweet message, which you have to read and write your own
                    18 tweet reply. No one enjoys typing messages back and forth!
                </p>

                <h5 class="mt-4">What's the solution?</h5>

                <p>
                    <img src="https://media.giphy.com/media/RK4ezIEd1IBP2/giphy.gif" alt="A picture is worth a thousand words" style="width: 480px; height: 270px; left: 0px; top: 0px;">
                </p>

                <p>
                    If a picture is worth a thousand words, then a GIF must be worth at least 100 times that!
                </p>

                <p>
                    We've worked hard to pioneer a new form of social networking communication, so you never have to send
                    a text message ever again. Giphr allows you to tell the world what you are thinking simply by posting
                    a GIF!
                </p>

                <p>
                    <img src="https://media.giphy.com/media/l41YlHs99JsSptZf2/giphy.gif" alt="A picture is worth a thousand words" style="width: 480px; height: 270px; left: 0px; top: 0px;">
                </p>

                <h5>The power of Giphy, at your fingertips</h5>

                <p>
                    Giphr is built on top of the worlds best GIF hosting and search service: Giphy! So if you can't find
                    the GIF you want, blame them.
                </p>

                <h5>What else is there to say?</h5>

                <p>
                    I know what you're thinking, how much does it cost to use such an incredible serivce... absolutely nothing!
                    So click below to create your account and get Giphing&trade;!
                </p>

                <a href="{{ url('/login/twitter') }}" class="btn btn-lg btn-block btn-primary btn-twitter"><i class="fa fa-twitter"></i> Login with Twitter</a>
            </div>

        </div>
    </div>
@endsection
