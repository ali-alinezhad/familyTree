@extends('layouts.app')
@section('third_party_stylesheets')
    <style>


.b-0 {
bottom: 0;
}
.bg-shadow {
background: rgba(76, 76, 76, 0);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(179, 171, 171, 0)), color-stop(49%, rgba(48, 48, 48, 0.37)), color-stop(100%, rgba(19, 19, 19, 0.8)));
background: linear-gradient(to bottom, rgba(179, 171, 171, 0) 0%, rgba(48, 48, 48, 0.71) 49%, rgba(19, 19, 19, 0.8) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c4c4c', endColorstr='#131313', GradientType=0 );
}
.top-indicator {
right: 0;
top: 1rem;
bottom: inherit;
left: inherit;
margin-right: 1rem;
}
.overflow {
position: relative;
overflow: hidden;
}
.zoom img {
transition: all 0.2s linear;
}
.zoom:hover img {
-webkit-transform: scale(1.1);
transform: scale(1.1);
}
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('translations.news') }}</h1>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
    </div>





    <!--Container-->
    <div class="container">
        <div class="row mb-2">
            <div class="col-12 text-center pt-3">

            </div>
        </div>

        <!--Start code-->
        <div class="row">
            <div class="col-12 pb-5">
                <!--SECTION START-->
                <section class="row">
                    <!--Start slider news-->
                    <div class="col-12 col-md-6 pb-0 pb-md-3 pt-2 pr-md-1">
                        <div id="featured" class="carousel slide carousel" data-ride="carousel">
                            <!--dots navigate-->
                            <ol class="carousel-indicators top-indicator">
                                <li data-target="#featured" data-slide-to="0" class="active"></li>
                                <li data-target="#featured" data-slide-to="1"></li>
                                <li data-target="#featured" data-slide-to="2"></li>
                                <li data-target="#featured" data-slide-to="3"></li>
                            </ol>

                            <!--carousel inner-->
                            <div class="carousel-inner">
                                <!--Item slider-->
                                <div class="carousel-item active">
                                    <div class="card border-0 rounded-0 text-light overflow zoom">
                                        <div class="position-relative">
                                            <!--thumbnail img-->
                                            <div class="ratio_left-cover-1 image-wrapper">
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <img class="img-fluid w-100"
                                                         src="https://bootstrap.news/source/img1.jpg"
                                                         alt="Bootstrap news template">
                                                </a>
                                            </div>
                                            <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                <!--title-->
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <h2 class="h3 post-title text-white my-1">Bootstrap 4 template news portal magazine perfect for news site</h2>
                                                </a>
                                                <!-- meta title -->
                                                <div class="news-meta">
                                                    <span class="news-author">by <a class="text-white font-weight-bold" href="../category/author.html">Jennifer</a></span>
                                                    <span class="news-date">Oct 22, 2019</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Item slider-->
                                <div class="carousel-item">
                                    <div class="card border-0 rounded-0 text-light overflow zoom">
                                        <div class="position-relative">
                                            <!--thumbnail img-->
                                            <div class="ratio_left-cover-1 image-wrapper">
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <img class="img-fluid w-100"
                                                         src="https://bootstrap.news/source/img2.jpg"
                                                         alt="Bootstrap news theme">
                                                </a>
                                            </div>
                                            <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                <!--title-->
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <h2 class="h3 post-title text-white my-1">Walmart shares up 10% on online sales lift</h2>
                                                </a>
                                                <!-- meta title -->
                                                <div class="news-meta">
                                                    <span class="news-author">by <a class="text-white font-weight-bold" href="../category/author.html">Jennifer</a></span>
                                                    <span class="news-date">Oct 22, 2019</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Item slider-->
                                <div class="carousel-item">
                                    <div class="card border-0 rounded-0 text-light overflow zoom">
                                        <div class="position-relative">
                                            <!--thumbnail img-->
                                            <div class="ratio_left-cover-1 image-wrapper">
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <img class="img-fluid w-100"
                                                         src="https://bootstrap.news/source/img3.jpg"
                                                         alt="Bootstrap blog template">
                                                </a>
                                            </div>
                                            <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                <!--title-->
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <h2 class="h3 post-title text-white my-1">Bank chief warns on Brexit staff moves to other company</h2>
                                                </a>
                                                <!-- meta title -->
                                                <div class="news-meta">
                                                    <span class="news-author">by <a class="text-white font-weight-bold" href="../category/author.html">Jennifer</a></span>
                                                    <span class="news-date">Oct 22, 2019</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Item slider-->
                                <div class="carousel-item">
                                    <div class="card border-0 rounded-0 text-light overflow zoom">
                                        <div class="position-relative">
                                            <!--thumbnail img-->
                                            <div class="ratio_left-cover-1 image-wrapper">
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <img class="img-fluid w-100"
                                                         src="https://bootstrap.news/source/img4.jpg"
                                                         alt="Bootstrap portal template">
                                                </a>
                                            </div>
                                            <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                <!--title-->
                                                <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                    <h2 class="h3 post-title text-white my-1">The world's first floating farm making waves in Rotterdam</h2>
                                                </a>
                                                <!-- meta title -->
                                                <div class="news-meta">
                                                    <span class="news-author">by <a class="text-white font-weight-bold" href="../category/author.html">Jennifer</a></span>
                                                    <span class="news-date">Oct 22, 2019</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end item slider-->
                            </div>
                            <!--end carousel inner-->
                        </div>

                        <!--navigation-->
                        <a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#featured" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!--End slider news-->

                    <!--Start box news-->
                    <div class="col-12 col-md-6 pt-2 pl-md-1 mb-3 mb-lg-4">
                        <div class="row">
                            <!--news box-->
                            <div class="col-6 pb-1 pt-0 pr-1">
                                <div class="card border-0 rounded-0 text-white overflow zoom">
                                    <div class="position-relative">
                                        <!--thumbnail img-->
                                        <div class="ratio_right-cover-2 image-wrapper">
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <img class="img-fluid"
                                                     src="https://bootstrap.news/source/img5.jpg"
                                                     alt="simple blog template bootstrap">
                                            </a>
                                        </div>
                                        <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                            <!-- category -->
                                            <a class="p-1 badge badge-primary rounded-0" href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Lifestyle</a>

                                            <!--title-->
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <h2 class="h5 text-white my-1">Should you see the Fantastic Beasts sequel?</h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--news box-->
                            <div class="col-6 pb-1 pl-1 pt-0">
                                <div class="card border-0 rounded-0 text-white overflow zoom">
                                    <div class="position-relative">
                                        <!--thumbnail img-->
                                        <div class="ratio_right-cover-2 image-wrapper">
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <img class="img-fluid"
                                                     src="https://bootstrap.news/source/img6.jpg"
                                                     alt="bootstrap templates for blog">
                                            </a>
                                        </div>
                                        <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                            <!-- category -->
                                            <a class="p-1 badge badge-primary rounded-0" href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Motocross</a>
                                            <!--title-->
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <h2 class="h5 text-white my-1">Three myths about Florida elections recount</h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--news box-->
                            <div class="col-6 pb-1 pr-1 pt-1">
                                <div class="card border-0 rounded-0 text-white overflow zoom">
                                    <div class="position-relative">
                                        <!--thumbnail img-->
                                        <div class="ratio_right-cover-2 image-wrapper">
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <img class="img-fluid"
                                                     src="https://bootstrap.news/source/img7.jpg"
                                                     alt="bootstrap blog wordpress theme">
                                            </a>
                                        </div>
                                        <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                            <!-- category -->
                                            <a class="p-1 badge badge-primary rounded-0" href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Fitness</a>
                                            <!--title-->
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <h2 class="h5 text-white my-1">Finding Empowerment in Two Wheels and a Helmet</h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--news box-->
                            <div class="col-6 pb-1 pl-1 pt-1">
                                <div class="card border-0 rounded-0 text-white overflow zoom">
                                    <div class="position-relative">
                                        <!--thumbnail img-->
                                        <div class="ratio_right-cover-2 image-wrapper">
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <img class="img-fluid"
                                                     src="https://bootstrap.news/source/img8020.jpg"
                                                     alt="blog website templates bootstrap">
                                            </a>
                                        </div>
                                        <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                            <!-- category -->
                                            <a class="p-1 badge badge-primary rounded-0" href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Adventure</a>
                                            <!--title-->
                                            <a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                <h2 class="h5 text-white my-1">Ditch receipts and four other tips to be a shopper</h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end news box-->
                        </div>
                    </div>
                    <!--End box news-->
                </section>
                <!--END SECTION-->
            </div>
        </div>
        <!--end code-->
    </div>




@endsection
