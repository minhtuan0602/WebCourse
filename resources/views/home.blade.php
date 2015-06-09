<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Trang chủ</title>
  
  <script src="/home_page/jquery/jquery.js"></script>
  <script src="/home_page/GSAP/TweenLite.min.js"></script>
  <script src="/home_page/GSAP/plugins/CSSPlugin.min.js"></script>
  <script src="/home_page/GSAP/plugins/ScrollToPlugin.min.js"></script>
  <link rel="stylesheet" href="/home_page/style/style.css">
</head>
<body style="margin:0px;padding:0px">
    <div id="container">
        <div id="navbar"></div>
        <div id="listcate">
            <div id="listcateul">
                <div id="btnclose"></div>
            </div>
        </div>
        <article id="news">
            <div id="newstopbg">
                <div class="newsbg"></div>
                <div class="newsbg"></div>
            </div>
            <div id="newsbody">
                <img id="newslogo" src="/home_page/images/logo.png">  
                <div id = "listnewssec">
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news1.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news2.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news3.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news4.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news5.jpg')"></div></section>
                </div>
                <div id = "listpoint"></div>
                <div id = "newsbottom">
                    <div id="newsbtn">TIN TỨC</div>    
                </div>    
            </div>
            <div id="art">
                <div class="titleart">
                    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam
                </div>
                <div class="bodyart">
                    <p>
                    <a href="lol.com">Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam</a>. Integer
                    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
                    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
                    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
                    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
                    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
                    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
                    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
                    amet, nunc. Nam a nibh. Donec suscipit eros./.</p>
                </div>
            </div>
        </article>
        <article id="academics">
            <div class="acabg1"></div>
            <div class="acabg1"></div>
            <div class="acabg2"></div>
            <div class="acabg2"></div>
            <div id = "listsec">
                <div id="listsecbg"></div>
                <?php $i = 1; ?>
                @foreach ($articles_training as $article)
                    <section>
                        <div class="bgveil"></div>
                        <div class="bg"><img class="bgimg" src="/home_page/images/aca{{ $i }}.jpg"></div>
                        <div class="title">{{ $article->title }}</div>
                        <div class="description">{{ $article->description }}</div>
                        <div class="acatext">{!! html_entity_decode($article->content) !!}</div>
                    </section>
                    <?php $i++; ?>
                @endforeach
            </div>
        </article>
        <article id="research">
            <div id="headerresearch"></div>
            <div id="leftresearch">
                <div id="leftresearchbar" class="top0"></div>
                <div id="scircleresearch"></div>
            </div>
            <div id="researchgroup">
                <div class="titlegroup">LĨNH VỰC NGHIÊN CỨU</div>
                <div class="titlegroup">CÁC BÀI BÁO KHOA HỌC</div>
            </div>
            <div id="accordion">
                @foreach( $articles_research_type_1 as $article)
                    <section class="SG0">
                        <div class="retitle"><div>{{ mb_strtoupper($article->title) }}</div></div>
                        <div class="retext">{!! html_entity_decode($article->content) !!}</div>
                    </section>
                @endforeach
                @foreach( $articles_research_type_2 as $article)
                    <section class="SG1">
                        <div class="retitle"><div>{{ $article->title }}</div></div>
                        <div class="retext">{!! html_entity_decode($article->content) !!}</div>
                    </section>
                @endforeach
            </div>
            <div id="footresearch"></div>
        </article>
        <article id="about">
            <div id="aboutcontent">
                <img id="logo" src="/home_page/images/logo.png">
                <div id="textabout">
                    @foreach ($articles_history as $article)
                        <div class="intextabout">{!! $article->content !!}</div>
                    @endforeach
                </div>
                <div id="aboutline"></div>
                <img id="aboutlinelogo" src="/home_page/images/logosd.png">
                <div id="abouthead">
                    @foreach ($articles_history as $article)
                        <div class="titleabout">{{ $article->title }}</div>
                    @endforeach
                </div>
            </div>
        </article>
    </div>
    <script src="/home_page/scripts/home.js"></script>
    <script src="/home_page/scripts/scroll.js"></script>
    <script src="/home_page/scripts/nav.js"></script>
    <script src="/home_page/scripts/academics.js"></script>
    <script src="/home_page/scripts/news.js"></script>
    <script src="/home_page/scripts/research.js"></script>
    <script src="/home_page/scripts/about.js"></script>
    <script type="text/javascript">
        var _NAVDATA = ['TRANG CHỦ', 'ĐÀO TẠO', 'NGHIÊN CỨU', 'GIỚI THIỆU'];
        var _CATEDATA = ['TẤT CẢ TIN'];
        var _CATEID = [];
        <?php
        foreach ($category_news as $category) { ?>
            _CATEDATA.push('<?php echo $category->name; ?>'.toUpperCase());
            _CATEID.push(<?php echo $category->id; ?>);
        <?php
        }
        ?>
    </script>
</body>
</html>
