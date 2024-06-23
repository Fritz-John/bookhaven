<!DOCTYPE html>
<html lang="en">
@include('partials.header')


<body>
    <header class="header">
        @include('partials.nav')
    </header>

    <main>
        <div class="container">
            {{$slot}}
        </div>


    </main>



    @include('partials.footer')
</body>

</html>