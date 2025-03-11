@extends('front.layouts.main')
@push('seo_meta_tag')
  @include('front.layouts.404-header')
@endpush
@section('main-section')
  <style>
    .bg-light-gray {
      background: #f9f9f9;
      padding: 100px 0px 60px 0px
    }

    .blankp h1 {
      font-size: 150px;
      display: contents;
      color: #002147;
      font-weight: bold
    }

    .blankp h2 {
      font-size: 40px;
      color: #002147
    }

    .bg-light-gray p {
      margin-bottom: 15px
    }

    .blank-btn {
      position: relative;
      display: inline-block;
      overflow: hidden;
      transition: .3s;
      padding: 12px 24px;
      text-align: center;
      border: solid 0px #074a83;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      color: #fff;
      background-color: #074a83;
      border-radius: 4px;
    }

    .blank-btn:before {
      content: "";
      position: absolute;
      padding: .1em;
      margin: 0 1em 0 0;
      top: 0;
      right: 100%;
      height: 100%;
      width: 120%;
      background-color: #002147;
      transform: skewX(-30deg);
      transition: inherit
    }

    .blank-btn:active {
      color: #fff !important
    }

    .blank-btn:focus {
      color: #fff !important
    }

    .blank-btn:hover:before {
      right: -20%;
      color: #fff !important
    }

    .blank-btn:hover {
      color: #fff !important
    }

    .blank-btn span {
      position: relative;
      color: #fff !important
    }

    @media (max-width:767px) {
      .bg-light-gray {
        text-align: center;
        padding: 100px 0px 30px 0px
      }

      .blankp h1 {
        font-size: 100px;
      }

      .blankp h2 {
        font-size: 25px;
        margin-top: 10px !important;
      }

      .blank-btn {
        width: 100%;
      }

      .hithere {
        margin-bottom: 30px
      }
    }

    .loader {
      background: linear-gradient(to right, rgb(22, 113, 202) 50%, transparent 50%);
      animation: spin 1s infinite linear;
    }

    .loader:before {
      display: block;
      content: '';
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 90px;
      height: 90px;
      background: #222;
      border-radius: 50%;
    }

    .gelatine {
      animation: gelatine 0.5s infinite;
    }

    @keyframes gelatine {

      from,
      to {
        transform: scale(1, 1);
      }

      25% {
        transform: scale(0.9, 1.1);
      }

      50% {
        transform: scale(1.1, 0.9);
      }

      75% {
        transform: scale(0.95, 1.05);
      }
    }

    .spin {
      animation: spin 1s infinite linear;
    }

    @keyframes spin {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }

    .elastic-spin {
      animation: elastic-spin 1s infinite ease;
    }

    @keyframes elastic-spin {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(720deg);
      }
    }

    .pulse {
      animation: pulse 1s infinite ease-in-out alternate;
    }

    @keyframes pulse {
      from {
        transform: scale(0.8);
      }

      to {
        transform: scale(1.2);
      }
    }

    .flash {
      animation: flash 500ms ease infinite alternate;
    }

    @keyframes flash {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
      }
    }

    .hithere {
      animation: hithere 2s ease infinite;
    }

    @keyframes hithere {
      30% {
        transform: scale(1.2);
      }

      40%,
      60% {
        transform: rotate(-20deg) scale(1.2);
      }

      50% {
        transform: rotate(20deg) scale(1.2);
      }

      70% {
        transform: rotate(0deg) scale(1.2);
      }

      100% {
        transform: scale(1);
      }
    }

    .grow {
      animation: grow 2s ease infinite;
    }

    @keyframes grow {
      from {
        transform: scale(0);
      }

      to {
        transform: scale(1);
      }
    }

    .fade-in {
      animation: fade-in 2s linear infinite;
    }

    @keyframes fade-in {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .fade-out {
      animation: fade-out 2s linear infinite;
    }

    @keyframes fade-out {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
      }
    }

    .bounce {
      animation: bounce 2s ease infinite;
    }

    @keyframes bounce {
      70% {
        transform: translateY(0%);
      }

      80% {
        transform: translateY(-15%);
      }

      90% {
        transform: translateY(0%);
      }

      95% {
        transform: translateY(-7%);
      }

      97% {
        transform: translateY(0%);
      }

      99% {
        transform: translateY(-3%);
      }

      100% {
        transform: translateY(0);
      }
    }

    .bounce2 {
      animation: bounce2 2s ease infinite;
    }

    @keyframes bounce2 {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateY(0);
      }

      40% {
        transform: translateY(-30px);
      }

      60% {
        transform: translateY(-15px);
      }
    }

    .shake {
      animation: shake 2s ease infinite;
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      10%,
      30%,
      50%,
      70%,
      90% {
        transform: translateX(-10px);
      }

      20%,
      40%,
      60%,
      80% {
        transform: translateX(10px);
      }
    }

    .flip {
      backface-visibility: visible !important;
      animation: flip 2s ease infinite;
    }

    @keyframes flip {
      0% {
        transform: perspective(400px) rotateY(0);
        animation-timing-function: ease-out;
      }

      40% {
        transform: perspective(400px) translateZ(150px) rotateY(170deg);
        animation-timing-function: ease-out;
      }

      50% {
        transform: perspective(400px) translateZ(150px) rotateY(190deg) scale(1);
        animation-timing-function: ease-in;
      }

      80% {
        transform: perspective(400px) rotateY(360deg) scale(.95);
        animation-timing-function: ease-in;
      }

      100% {
        transform: perspective(400px) scale(1);
        animation-timing-function: ease-in;
      }
    }

    .swing {
      transform-origin: top center;
      animation: swing 2s ease infinite;
    }

    @keyframes swing {
      20% {
        transform: rotate(15deg);
      }

      40% {
        transform: rotate(-10deg);
      }

      60% {
        transform: rotate(5deg);
      }

      80% {
        transform: rotate(-5deg);
      }

      100% {
        transform: rotate(0deg);
      }
    }

    .wobble {
      animation: wobble 2s ease infinite;
    }

    @keyframes wobble {
      0% {
        transform: translateX(0%);
      }

      15% {
        transform: translateX(-25%) rotate(-5deg);
      }

      30% {
        transform: translateX(20%) rotate(3deg);
      }

      45% {
        transform: translateX(-15%) rotate(-3deg);
      }

      60% {
        transform: translateX(10%) rotate(2deg);
      }

      75% {
        transform: translateX(-5%) rotate(-1deg);
      }

      100% {
        transform: translateX(0%);
      }
    }

    .fade-in-down {
      animation: fade-in-down 2s ease infinite;
    }

    @keyframes fade-in-down {
      0% {
        opacity: 0;
        transform: translateY(-20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in-left {
      animation: fade-in-left 2s ease infinite;
    }

    @keyframes fade-in-left {
      0% {
        opacity: 0;
        transform: translateX(-20px);
      }

      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .fade-out-down {
      animation: fade-out-down 2s ease infinite;
    }

    @keyframes fade-out-down {
      0% {
        opacity: 1;
        transform: translateY(0);
      }

      100% {
        opacity: 0;
        transform: translateY(20px);
      }
    }

    .fade-out-right {
      animation: fade-out-right 2s ease infinite;
    }

    @keyframes fade-out-right {
      0% {
        opacity: 1;
        transform: translateX(0);
      }

      100% {
        opacity: 0;
        transform: translateX(20px);
      }
    }

    .bounce-in {
      animation: bounce-in 2s ease infinite;
    }

    @keyframes bounce-in {
      0% {
        opacity: 0;
        transform: scale(.3);
      }

      50% {
        opacity: 1;
        transform: scale(1.05);
      }

      70% {
        transform: scale(.9);
      }

      100% {
        transform: scale(1);
      }
    }

    .bounce-in-right {
      animation: bounce-in-right 2s ease infinite;
    }

    @keyframes bounce-in-right {
      0% {
        opacity: 0;
        transform: translateX(2000px);
      }

      60% {
        opacity: 1;
        transform: translateX(-30px);
      }

      80% {
        transform: translateX(10px);
      }

      100% {
        transform: translateX(0);
      }
    }

    .bounce-out {
      animation: bounce-out 2s ease infinite;
    }

    @keyframes bounce-out {
      0% {
        transform: scale(1);
      }

      25% {
        transform: scale(.95);
      }

      50% {
        opacity: 1;
        transform: scale(1.1);
      }

      100% {
        opacity: 0;
        transform: scale(.3);
      }
    }

    .bounce-out-down {
      animation: bounce-out-down 2s ease infinite;
    }

    @keyframes bounce-out-down {
      0% {
        transform: translateY(0);
      }

      20% {
        opacity: 1;
        transform: translateY(-20px);
      }

      100% {
        opacity: 0;
        transform: translateY(20px);
      }
    }

    .rotate-in-down-left {
      animation: rotate-in-down-left 2s ease infinite;
    }

    @keyframes rotate-in-down-left {
      0% {
        transform-origin: left bottom;
        transform: rotate(-90deg);
        opacity: 0;
      }

      100% {
        transform-origin: left bottom;
        transform: rotate(0);
        opacity: 1;
      }
    }

    .rotate-in-up-left {
      animation: rotate-in-up-left 2s ease infinite;
    }

    @keyframes rotate-in-up-left {
      0% {
        transform-origin: left bottom;
        transform: rotate(90deg);
        opacity: 0;
      }

      100% {
        transform-origin: left bottom;
        transform: rotate(0);
        opacity: 1;
      }
    }

    .hinge {
      animation: hinge 2s ease infinite;
    }

    @keyframes hinge {
      0% {
        transform: rotate(0);
        transform-origin: top left;
        animation-timing-function: ease-in-out;
      }

      20%,
      60% {
        transform: rotate(80deg);
        transform-origin: top left;
        animation-timing-function: ease-in-out;
      }

      40% {
        transform: rotate(60deg);
        transform-origin: top left;
        animation-timing-function: ease-in-out;
      }

      80% {
        transform: rotate(60deg) translateY(0);
        opacity: 1;
        transform-origin: top left;
        animation-timing-function: ease-in-out;
      }

      100% {
        transform: translateY(700px);
        opacity: 0;
      }
    }

    .roll-in {
      animation: roll-in 2s ease infinite;
    }

    @keyframes roll-in {
      0% {
        opacity: 0;
        transform: translateX(-100%) rotate(-120deg);
      }

      100% {
        opacity: 1;
        transform: translateX(0px) rotate(0deg);
      }
    }

    .roll-out {
      animation: roll-out 2s ease infinite;
    }

    @keyframes roll-out {
      0% {
        opacity: 1;
        transform: translateX(0px) rotate(0deg);
      }

      100% {
        opacity: 0;
        transform: translateX(100%) rotate(120deg);
      }
    }
  </style>
  <div class="bg-light-gray">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center">
          <img src="<?php echo asset('front/img/404.png'); ?>" alt="404 error" class="hithere" style="width:450px;" data-was-processed="true">
        </div>
        <div class="col-md-6">
          <div class="blankp">
            <h1>404</h1>
            <h2>Someone is so lost.</h2>
            <p>The page you are looking for does not exist. How you got here is a mystery. But you can click the button
              below to go back to the homepage.</p>
            <a href="{{ url('/') }}" class="blank-btn"><span>Home</span></a>
            <a href="{{ route('cim') }}" class="blank-btn"><span>Courses in Malaysia</span></a>
            <a href="{{ route('uim') }}" class="blank-btn"><span>Malaysian Universities</span></a>
            <a href="{{ url('blog') }}" class="blank-btn"><span>Blog</span></a>
            <a href="{{ url('scholarships') }}" class="blank-btn"><span>Scholarship</span></a>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
