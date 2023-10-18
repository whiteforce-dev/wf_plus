@extends('master.master')
@section('title', 'Pipeline')
@section('content')

@section('css')
<style>
    .all-pipeline {
        padding: 2%;
        width: auto;
        overflow-x: auto;
        height: 100vh;
    }

    .pipeline {
        display: flex;
        overflow-x: auto;
        width: 94%;
    }

    .position {
        min-height: 90vh;
        /* height: auto; */
        /* min-width: 328px; */
        width: 285px;
        /* border-top: 4px solid #AD4F4F; */
        border-radius: 8px;
        margin: 0 10px;
        padding: 12px;
    }

    .position:nth-child(even) {
        border-top: 4px solid #AD4F4F;
        background: #fff;
        /* background: #FFC107; */
    }

    .position:nth-child(odd) {
        border-top: 4px solid #ee8f00;
        /* background: #b4b4b421; */
        background: #fff;
    }

    .title {
        margin: 0px 10% 20px;
        display: flex;
        align-items: center;
    }

    .title h6 {
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 0.6px;
        margin: 0;
    }

    .title p {
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 0.6px;
        width: 50px;
        height: 22px;
        background: linear-gradient(30deg, #B21332, #3D0D36);
        margin: 0 10px;
        border-radius: 20px;
        text-align: center;
        color: #ffffff;
    }


    .pipeline-card {
        width: 100%;
        height: auto;
        background: #e5e5e561;
        border-radius: 20px;
        margin: 20px 0;
        padding: 20px 11px;
    }



    .interview-status span {
        background: linear-gradient(to right, #f00000, #dc281e);
        font-size: 10px;
        font-weight: normal;
    }

    .dropbtn:hover,
    .dropbtn:focus {
        background-color: #3e8e41;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 0px 16px 0px rgb(0 0 0 / 16%);
        z-index: 1;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .dropdown-content p {
        color: black;
        text-decoration: none;
        display: block;
        font-size: 14px;
        margin: 6px 0;
        padding: 0;
    }

    .show {
        display: block;
    }

    .card {
        padding: 10px;
        border-radius: 6px;
        border: 2px solid #eee;
        box-shadow: none;
        margin: 6px 0;
    }

    hr {
        background: #d7d7d791;
        margin: 0;
    }

    .card-head .candidate-name h6 {
        font-size: 14px;
        font-weight: 700;
        margin: 0 0 4px 0;
        color: #111;
    }

    .card-head .candidate-name p {
        font-size: 11px;
        font-weight: 500;
        color: #999999;
    }

    .card-head .card-dropdown {
        height: 26px;
        width: 26px;
    }

    .card-head .card-dropdown:hover {
        cursor: pointer;
    }

    .card-head .card-dropdown .dropdown button {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }

    .card-content {
        padding: 10px 0;
        position: relative;
    }

    .card-content .candidate-details {
        align-items: center;
    }

    .card-content .candidate-details .details-title {
        font-size: 12px;
        display: flex;
        align-items: center;
        width: 100%;
        color: #4a1b1b;
        font-weight: 500;
    }

    .card-content .candidate-details .details-title i {
        font-size: 14px;
        width: 24px;
        height: 24px;
    }

    .bg-badge-warning {
        background-color: #ffcf004d;
        color: #4e4e4e;
        margin: 0;
        padding: 6px;

        font-size: 10px;
        /* margin: auto; */
        text-align: left;
        width: fit-content;
    }

    .bg-badge-danger {
        background-color: #ffd6d6f5;
        color: #a10000;
        margin: 0;
        padding: 6px;

        font-size: 10px;
        /* margin: auto; */
        text-align: left;
        width: fit-content;
    }

    .bg-badge-pending {
        background-color: #00978669;
        color: #00322d;
        margin: 0;
        padding: 6px;

        font-size: 10px;
        /* margin: auto; */
        text-align: left;
        width: fit-content;
    }

    .bg-badge-telephonic {
        background-color: #ebd8c1;
        color: #5f2800;
        margin: 0;
        padding: 6px;

        font-size: 10px;
        /* margin: auto; */
        text-align: left;
        width: fit-content;
    }

    .bg-badge-success {
        background-color: rgba(0, 128, 0, 0.5);
        color: rgb(0, 43, 0);
        margin: 0;
        padding: 6px;

        font-size: 10px;
        /* margin: auto; */
        text-align: left;
        width: fit-content;
    }

    .checkbox-wrapper-26 {
        margin-right: 8px;
    }





    .positionTitle h5 {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .positionTitle p {
        font-size: 13px;
        font-weight: 500;
        margin: 0;
    }

    .positionButtons {
        text-align: end;
        position: relative;
    }

    .positionButtons .filter-Pipeline .filter-people {
        font-size: 10px;
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: start;
        position: relative;
    }

    .filter-Pipeline .filter-people .filterPerson {
        width: 36px;
        height: 36px;
        background-color: white;
        border-radius: 50%;
        border: 2px solid #fff;
        color: darkblue;
    }

    .filter-Pipeline .filter-people .filterPerson:hover {
        cursor: pointer;
    }

    .filter-Pipeline .filter-people .filterPerson img {
        max-width: 100%;
        border-radius: 50%;
        max-height: 100%;
    }

    .personPosition-1 {
        position: absolute;
        top: 0;
        right: 0px;
        font-size: 12px;
        font-weight: 500;
        /* background: #f3f5f7 !important; */
        display: grid;
        place-content: center;
    }

    .personPosition-2 {
        position: absolute;
        top: 0;
        right: 26px;
    }

    .personPosition-3 {
        position: absolute;
        top: 0;
        right: 50px;
    }

    .personPosition-4 {
        position: absolute;
        top: 0;
        right: 74px;
    }

    .personPosition-5 {
        position: absolute;
        top: 0;
        right: 97px;
    }

    .pipeline-Added {
        margin-top: 10px;
        height: 18px;
    }

    .pipeline-Added .details-title {
        font-size: 10px;
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: start;
    }

    .pipeline-Added .details-title .added-co {
        width: 28px;
        height: 28px;
        background-color: white;
        border-radius: 50%;
        border: 2px solid #fff;

        position: absolute;
        bottom: 8px;
        right: -7px;
    }

    .pipeline-Added .details-title .added-co:hover {
        cursor: pointer;
    }

    .pipeline-Added .details-title .added-co img {
        max-width: 100%;
        border-radius: 50%;
        max-height: 100%;
    }

    .pipeline-Added .details-title .added-pco {
        width: 28px;
        height: 28px;
        background-color: white;
        border-radius: 50%;
        border: 2px solid #fff;

        position: absolute;
        bottom: 8px;
        right: 30px;
    }

    .pipeline-Added .details-title .added-pco img {
        max-width: 100%;
        border-radius: 50%;
        max-height: 100%;
    }

    .pipeline-Added .details-title .added-pco:hover {
        cursor: pointer;
    }

    .score-status {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .percentage-score {
        width: 36px;
        height: 36px;
        background: #e5e9eb;
        border-radius: 50%;
        display: grid;
        place-content: center;
        position: absolute;
        top: 14px;
        right: 8px;
        font-size: 12px;
        font-weight: 700;
    }


    .wrapper-center {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .progress-bar {
        background: #000;
        width: 200px;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        position: relative;
    }

    .progress-bar:before {
        content: "";
        position: absolute;
        right: 0;
        width: 50%;
        height: 100%;
        background: #444;
        z-index: 0;
    }

    /*===== The CSS =====*/
    .progress {
        width: 50px;
        height: 58px;
        z-index: 1;
        background: none;
    }

    .progress .track,
    .progress .fill {
        fill: rgba(0, 0, 0, 0);
        stroke-width: 3;
        transform: rotate(90deg)translate(0px, -80px);
    }

    .progress .track {
        stroke: #c4c4c4;
    }

    .progress .fill {
        stroke: #363636;
        stroke-dasharray: 219.99078369140625;
        stroke-dashoffset: -219.99078369140625;
        transition: stroke-dashoffset 1s;
    }

    .progress .value {
        fill: #000000;
        text-anchor: middle;
        font-size: 20px;
    }

    .progress .text {
        font-size: 12px;
        fill: #fff;
        text-anchor: middle;
    }

    .progress .track,
    .progress .fill {
        stroke-width: 4px;
    }

    .li {
        line-height: 5px !important
    }


    .pipeline-column::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }

    .header,
    .deznav {
        z-index: 999;
    }

    .nav-header {
        z-index: 9999 !important;
    }

    .percentage-score {
        width: 36px;
        height: 36px;
        background: #e5e9eb;
        border-radius: 50%;
        display: grid;
        place-content: center;
        position: absolute;
        top: -15px !important;
        right: 8px;
        font-size: 12px;
        font-weight: 700;
    }

    .right-Modal {
        background: rgb(98 98 98 / 59%);
    }

    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 642px;
        max-width: 642px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }


    /*Left*/
    .modal.left.fade .modal-dialog {
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: 0;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .candidate_Information {
        width: 55%;
    }

    .custom-modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #F2F7FA;
        height: auto !important;
    }

    .custom-modal-header .candidate_img {
        width: 80px;
        height: 80px;
        background: #f2f7fa;
        border-radius: 50%;
    }

    .custom-modal-header .candidate_img img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
    }

    .custom-btn {
        padding: 4px 18px;
        font-size: 12px;
    }

    .custom-modal-body {
        padding: 0;
    }

    .custom-nav-modal {
        padding: 0.8rem 1.4rem !important;
        color: #858585;
    }

    .custom-tab-content {
        padding: 22px;
    }

    .custom-card {
        border: 1px solid #d2d2d2;
    }

    .card-header h6 {
        color: #555555;
    }

    .candidate_mobile h6,
    .candidate_sourcedPosition h6,
    .candidate_qualification h6,
    .candidate_email h6,
    .candidate_prefLocation h6,
    .candidate_pincode h6 {
        font-size: 14px;
        font-weight: 600;
        color: #3c3c3c;
    }

    .candidate_mobile p,
    .candidate_sourcedPosition p,
    .candidate_qualification p,
    .candidate_email p,
    .candidate_prefLocation p,
    .candidate_pincode p {
        font-size: 12px;
        font-weight: 400;
        color: #353434;
    }

    .candidate_img {
        width: 96px;
        height: 96px;
    }

    .candidate_img img {
        max-width: 100%;
        max-height: 100%;
    }

    .openModal button i {
        font-size: 20px;
    }

    .footer_details {
        background-color: rgb(228, 230, 230);
        border-radius: 5px;
    }

    .footer_details p {
        font-size: 12px;
    }

    .candidate_details span {
        display: flex;
        justify-content: center;
    }

    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        bottom: 100%;
        left: 50%;
        margin-left: -60px;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
    }

    .modal-header {
        position: sticky;
        top: 0;
        /* background-color: inherit; [1] */
        z-index: 1055;
        /* [2] */
    }

    .modal-footer {
        position: sticky;
        bottom: 0;
        /* background-color: inherit; [1] */
        z-index: 1055;
        /* [2] */
    }

    .dropdown-menu {
        /* transform: translate(-215px, 23px) !important; */
    }

    .dropdown-menu .dropdown-item {
        font-size: 12px;
        color: #7e7e7e;
        padding: 0.5rem 1.75rem;
    }

    .pipeline-column {
        background: #ffffff;
    }





    .card {
        padding: 10px !important;
        border-radius: 6px !important;
        margin: 20px 0 !important;
        height: 230px !important;
        background: #f7f7f7;


        box-shadow: rgb(0 0 0 / 60%) 0px -36px 25px -40px inset;
        /* border: 2px solid #ffffff !important; */
        /* background: #df7142; */
        /* background: rgb(223, 113, 66); */
        /* background: linear-gradient(232deg, rgb(255 197 172) 0%, rgb(224 68 0) 100%); */
        /* background: linear-gradient(263deg, rgb(255 211 0) 0%, rgb(201 110 70) 100%); */
        /* color: #fff; */
        /* box-shadow: rgb(0 0 0 / 60%) 0px -50px 36px -28px inset; */
    }

    .card-head .candidate-name h6 {

        color: #000 !important;
    }

    .card-head .candidate-name p {
        font-size: 11px;
        font-weight: 500;
        color: #cb2f2f;
    }

    .pipelineDetails {
        padding: 10px 0px;
        width: 94%;
        max-width: 99%;
        margin: 20px;
        color: white;
        /* background: white; */
        border-radius: 10px
    }

    .filter-Pipeline .filter-people .filterPerson {
        background-color: #e6e6e6;
    }

    .pipeline-heading {
        background: #ffffff;
        z-index: 2 !important;
    }

    .tooltip {
        border-bottom: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .desc {
        padding: 15px;
        text-align: center;
    }

    [data-header-position="fixed"] .content-body {
        padding-top: 3.5rem !important;
    }



    .skeleton {
        /* animation: skeleton-loading 1s linear infinite alternate; */
    }

    @keyframes skeleton-loading {
        0% {
            background-color: hsl(200, 20%, 80%);
        }

        100% {
            background-color: hsl(200, 20%, 95%);
        }
    }

    .skeleton-text {
        width: 100%;
        height: 0.7rem;
        margin-bottom: 0.5rem;
        border-radius: 0.25rem;
    }

    .skeleton-text__body {
        width: 75%;
    }

    .skeleton-footer {
        width: 30%;
    }

    .check-xs {
        margin-top: 3px !important;
    }
</style>
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap"
    rel="stylesheet">
<style>
    ::-webkit-scrollbar {
        display: none;
    }

    [id*="candidate_section"] {
        margin-top: 20px
    }

    .card1.candidateCard {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 31px;
        /* box-shadow: 0 5px 14px -10px #cdcdcd; */
        transition: all 0.25s linear;
        border: 1px dashed #9f9f9f;
        overflow: hidden;
        height: 57px;
        background-color: #fff;
        box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;
    }

    .card1.candidateCard .inside {
        background: #FFE1CB;
        border-radius: 23px;
        padding: 0px 15px;
        padding-bottom: 10px;
    }

    .card1.candidateCard:hover,
    .card-dropdown:hover+.card1.candidateCard {
        box-shadow: 0 5px 14px -7px #999;
        height: 230px;
    }

    .card1.candidateCard .card-head {
        height: 40px;
        padding: 0 20px;
        margin-bottom: 14px;
    }

    .card1.candidateCard .card-head h6 {
        margin: 0;
        font-size: 13px;
        font-family: 'Raleway', sans-serif;
        font-weight: 700;
    }

    .card1.candidateCard .card-head p {
        margin: 0 !important;
        color: #aaa;
    }

    .card1.candidateCard .percentage-score {
        position: absolute;
        top: -55px !important;
        right: -15px !important;
        /* transform: scale(0.8); */
        transition: all 0.25s ease-in-out;
    }

    .card1.candidateCard:hover .percentage-score,
    .card-dropdown:hover+.card1.candidateCard .percentage-score {
        top: -15px !important;
        right: 10px !important;
    }

    .card-dropdown {
        position: absolute;
        top: 12px;
        right: -5px;
    }

    .card-dropdown button {
        outline: none !important;
        border: none !important;
        background: white;
    }

    /* .dropdown button{} */


    .position {
        max-height: 70vh;
        min-height: 70vh;
        overflow-y: auto;
        padding: 0;
    }

    .content-custom {
        margin-left: 5rem;
        padding-top: 3.5rem !important;
    }

    .positionHeading {
        position: sticky;
        height: 37px;
        background: white;
        z-index: 2;
        width: 285px;
        padding: 10px 22px;
        top: 0;
        left: 0;
    }

    .position-pipe {
        padding: 12px;
        margin-top: 8px;
    }




    .main-hr {
        width: 30%;
        border: none;
        border-top: 1px solid #c3c3c3;
    }

    .icon-btn {
        width: 50px;
        height: 50px;
        border: 1px solid #cdcdcd;
        background: white;
        border-radius: 25px;
        overflow: hidden;
        position: relative;
        transition: width 0.2s ease-in-out;
    }

    .add-btn:hover {
        width: 120px;
    }

    .add-btn::before,
    .add-btn::after {
        transition: width 0.2s ease-in-out, border-radius 0.2s ease-in-out;
        content: "";
        position: absolute;
        height: 4px;
        width: 10px;
        top: calc(50% - 2px);
        background: red;
    }

    .add-btn::after {
        right: 14px;
        overflow: hidden;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
    }

    .add-btn::before {
        left: 15px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }

    .icon-btn:focus {
        outline: none;
    }

    .btn-txt {
        opacity: 0;
        transition: opacity 0.2s;
    }

    .add-btn:hover::before,
    .add-btn:hover::after {
        width: 4px;
        border-radius: 2px;
    }

    .add-btn:hover .btn-txt {
        opacity: 1;
    }

    .add-icon::after,
    .add-icon::before {
        transition: all 0.2s ease-in-out;
        content: "";
        position: absolute;
        height: 20px;
        width: 2px;
        top: calc(50% - 10px);
        background: red;
        overflow: hidden;
    }

    .add-icon::before {
        left: 22px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }

    .add-icon::after {
        right: 22px;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
    }

    .add-btn:hover .add-icon::before {
        left: 15px;
        height: 4px;
        top: calc(50% - 2px);
    }

    .add-btn:hover .add-icon::after {
        right: 15px;
        height: 4px;
        top: calc(50% - 2px);
    }

    .pipelineChkBox {
        position: absolute;
        left: 15px;
        top: 11px;
    }


    .skeleton {
        padding-left: 28px !important;
        padding: 8px;
        max-width: 300px;
        width: 100%;
        background: #fff;
        margin-bottom: 20px;
        border-radius: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;
        /* box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .14), 0 3px 3px -2px rgba(0, 0, 0, .2), 0 1px 8px 0 rgba(0, 0, 0, .12); */
        border: 1px dashed #bba7a7;
    }

    .skeleton .square {
        height: 80px;
        border-radius: 5px;
        background: rgba(130, 130, 130, 0.2);
        background: -webkit-gradient(linear, left top, right top, color-stop(8%, rgba(130, 130, 130, 0.2)), color-stop(18%, rgba(130, 130, 130, 0.3)), color-stop(33%, rgba(130, 130, 130, 0.2)));
        background: linear-gradient(to right, rgba(130, 130, 130, 0.2) 8%, rgba(130, 130, 130, 0.3) 18%, rgba(130, 130, 130, 0.2) 33%);
        background-size: 800px 100px;
        animation: wave-squares 2s infinite ease-out;
    }

    .skeleton .line {
        height: 12px;
        margin-bottom: 6px;
        border-radius: 2px;
        background: rgba(130, 130, 130, 0.2);
        background: -webkit-gradient(linear, left top, right top, color-stop(8%, rgba(130, 130, 130, 0.2)), color-stop(18%, rgba(130, 130, 130, 0.3)), color-stop(33%, rgba(130, 130, 130, 0.2)));
        background: linear-gradient(to right, rgba(130, 130, 130, 0.2) 8%, rgba(130, 130, 130, 0.3) 18%, rgba(130, 130, 130, 0.2) 33%);
        background-size: 800px 100px;
        animation: wave-lines 2s infinite ease-out;
    }

    .skeleton-right {
        /* flex: 1; */
    }

    .skeleton-left {
        flex: 2;
        padding-right: 15px;
    }

    .flex1 {
        flex: 1;
    }

    .flex2 {
        flex: 2;
    }

    .skeleton .line:last-child {
        margin-bottom: 0;
    }

    .h8 {
        height: 8px !important;
    }

    .h10 {
        height: 10px !important;
    }

    .h12 {
        height: 12px !important;
    }

    .h15 {
        height: 15px !important;
    }

    .h17 {
        height: 17px !important;
    }

    .h20 {
        height: 20px !important;
    }

    .h25 {
        height: 25px !important;
    }

    .w25 {
        width: 25% !important
    }

    .w40 {
        width: 40% !important;
    }

    .w50 {
        width: 50% !important
    }

    .w75 {
        width: 75% !important
    }

    .m10 {
        margin-bottom: 10px !important;
    }

    .circle {
        border-radius: 50% !important;
        height: 47px !important;
        width: 47px;
    }

    @keyframes wave-lines {
        0% {
            background-position: -468px 0;
        }

        100% {
            background-position: 468px 0;
        }
    }

    @keyframes wave-squares {
        0% {
            background-position: -468px 0;
        }

        100% {
            background-position: 468px 0;
        }
    }

    .check-xs .form-check-input {
        width: 1.3rem;
        height: 1.3rem;
        border-radius: 10px;
    }

    #loader-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(8px);
    }

    .three-bounce {
        margin: 0;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .three-bounce .sk-child {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: var(--primary);
        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
        animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
    }

    .three-bounce .sk-bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .three-bounce .sk-bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    .pipeCan {
        display: block;
        position: relative;
        cursor: pointer;
        right: 0;
    }

    .dropdown-menu {
        z-index: 9 !important;
    }

    .btn-sm {
        padding: 9px 13px !important;
        font-weight: 500 !important;
    }

    .icons {
        color: #eb8153;
        font-size: 14px;
    }
</style>

@endsection
<div id="loader-container" style="display:none;">
    <div class="three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<div class="content-custom" style="min-height:634px !important;">

    <div class="row">
        <div
            class="pipelineDetails row justify-content-between align-items-center">
            <div class="positionTitle col-md-4">
                <div class="welcome-text" align="left">


                    <h4>
                        Position - <b style="color: #a15939;">{{
                            ucwords($position->position_name) }}</b>
                        <br>
                        <small style="font-size: 12px;">Client/Company - <a
                                href="{{ url('position?id='.$position->findClientGet->id) }}">{{
                                ucwords(
                                !empty($position->findClientGet) &&
                                !empty($position->findClientGet->name) ?
                                $position->findClientGet->name : '-',
                                ) }}</a></small>

                    </h4>


                    {{-- <h4 style="color: #ff5e5f;font-weight: 800;"> {{
                        ucwords($position->position_name) }}</h4>
                    <p class="mb-0" style="color: #7e1415;">
                        {{ ucwords(
                        !empty($position->findClientGet) &&
                        !empty($position->findClientGet->name) ?
                        $position->findClientGet->name : '-',
                        ) }}
                    </p> --}}
                </div>

            </div>
            <div class="positionButtons col-md-8">

                <div>
                    <li class="nav-item dropdown notification_dropdown">
                        <div class="form-check form-switch form-switch-sm"
                            style="margin-right: 10px;">
                            {{-- <input class="form-check-input" type="checkbox"
                                onclick="toggleJobProtals();" id="toogle_id"
                                checked> --}}
                            <label
                                style="right: 0; position:inherit; color: #7e1415;"
                                class="form-check-label"
                                for="flexSwitchCheckDefault">View :
                                &nbsp;
                                <b><select id="owners"
                                        onchange="showPipelineData();"
                                        style="border: none;background: none;">
                                        @if(in_array(Auth::user()->software_category
                                        , FRANCHISE_CATEGORY()))
                                        @if(in_array(Auth::user()->role ,
                                        ['manager', 'assistant_manager',
                                        'talent_acquisition']))
                                        <option value="{{ Auth::user()->id }}">
                                            {{ Auth::user()->name }} only
                                        </option>
                                        @else
                                        <option value="0">Created by all
                                        </option>
                                        @foreach ($users as $key => $user)
                                        <option value="{{ $user->id }}">{{
                                            $user->name }} only</option>
                                        @endforeach
                                        @endif

                                        @else
                                        <option value="0">Created by all
                                        </option>
                                        @foreach ($users as $key => $user)
                                        <option value="{{ $user->id }}">{{
                                            $user->name }} only</option>
                                        @endforeach
                                        @endif


                                    </select></b>&nbsp; &nbsp;</label>
                        </div>
                    </li>
                    {{-- <button class="btn btn-primary btn-sm"
                        style="margin-right: 10px;"
                        onclick="bulkBatchHeaderDownload()">Tracker&nbsp;&nbsp;<span
                            class="fa fa-download"></span></button>
                    <button class="btn btn-success btn-sm"
                        style="margin-right: 10px;"
                        onclick="bulkBatchHeaderDownload()">Batch
                        Header&nbsp;&nbsp;<span
                            class="fa fa-download"></span></button>

                    <button class="btn btn-success btn-sm"
                        style="margin-right: 5px;"
                        onclick="bulkBatchHeaderDownload()">Add
                        &nbsp;&nbsp;<span class="fa fa-plus"></span></button>
                    <button class="btn btn-danger btn-sm"
                        style="margin-right: 5px;"
                        onclick="bulkBatchHeaderDownload()">Remove
                        &nbsp;&nbsp;<span class="fa fa-times"></span></button>
                    --}}


                    <div class="btn-group" role="group"
                        aria-label="Button group with nested dropdown"
                        style="margin-right: 15px;">
                        <button type="button" onclick="setBulkInterview();"
                            class="btn btn-sm btn-light">Bulk
                            Interview&nbsp;&nbsp;&nbsp;<span
                                class="fa fa-briefcase icons"></span></button>
                        <button type="button" onclick="downloadTracker();"
                            class="btn btn-sm btn-light">Tracker&nbsp;&nbsp;&nbsp;<span
                                class="fa fa-file icons"></span></button>

                        <button onclick="bulkBatchHeaderDownload()"
                            type="button" class="btn-sm btn btn-light">Batch
                            Header&nbsp;&nbsp;&nbsp;<span
                                class="fa fa-download icons"></span></button>
                        <button onclick="showCandidateToAdd()" type="button"
                            class="btn btn-sm btn-light">Add
                            &nbsp;&nbsp;&nbsp;<span
                                class="fa fa-plus icons"></span></button>
                        @if (Auth::user()->role == 'admin')
                        <button onclick="deleteCandidate()" type="button"
                            class="btn btn-sm btn-danger">Remove
                            &nbsp;&nbsp;&nbsp;<span
                                class="fa fa-trash"></span></button>
                        @endif

                        {{-- <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button"
                                class="btn btn-success dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Dropdown
                            </button>
                            <div class="dropdown-menu"
                                aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">Dropdown
                                    link</a>
                                <a class="dropdown-item" href="#">Dropdown
                                    link</a>
                            </div>
                        </div> --}}
                    </div>






                    {{-- <button class="icon-btn add-btn"
                        onclick="showCandidateToAdd()">
                        <div class="add-icon"></div>
                        <div class="btn-txt">Add</div> --}}
                        {{--
                    </button> --}}
                    {{-- @if (Auth::user()->role == 'admin') --}}
                    {{-- <button class="icon-btn add-btn"
                        onclick="deleteCandidate()">
                        <div class="btn-txt">Remove</div>
                    </button> --}}
                    {{-- @endif --}}

                </div>

            </div>
        </div>



        <div class="pipeline">

            @foreach ($stages as $key => $stage)
            <div class="col-md-3 position" id="{{ strtolower($stage) }}_section"
                style="{{ $key == 'Joined' ? 'background: #b8f400b0' : '' }}">

                <script>
                    $(function() {
                            var stage = "{{ $stage }}";
                            getCandidateAccordingStage(stage);
                        });
                </script>
                <div class="positionHeading d-flex justify-content-between">
                    <h5>{{ strtoupper($stage) }}</h5>

                    <p id="{{ $key }}_count"><span class="badge badge-primary"
                            style="    position: relative;top: -3px; border-radius:70px;"
                            id="{{ ucwords($stage) }}_count">{{ $$stage
                            }}</span>
                    </p>
                </div>
                <div class="position-pipe"
                    id="{{ strtolower($stage) }}_candidate_section">

                    @for ($i = 0; $i < 10; $i++) <div class="skeleton">
                        <div class="skeleton-left">
                            <div class="line"></div>
                            <div class="line  w75"></div>
                        </div>
                        <div class="skeleton-right">
                            <div class="square circle"></div>
                        </div>
                </div>
                @endfor



            </div>
        </div>
        @endforeach
    </div>
</div>
</div>

<style>
    .show-can {
        padding: 5px 35px;
        border-radius: 115px;
        margin: 10px 5px;
        background: #fb6423a6;
        border-color: #ff682600;
        font-weight: 600;
        position: relative;
    }

    .cross {
        margin-left: 10px;
        position: absolute;
        top: 35%;
        right: 6%;
        font-size: 15px;
    }

    .ccscroll {
        padding: 4px;
        overflow-y: auto;
        white-space: nowrap;
        cursor: grab;
    }

    #sel-can-section::-webkit-scrollbar {
        display: block !important;
        height: 5px !important;
    }
</style>
<form action="{{ url('download-bulk-batch-header') }}"
    id="bulk_batch_header_form" method="post" style="display:none">
    @csrf
    <input type="hidden" name="selected_pipeline_ids" id="selected_pipeline_ids"
        value=''>
</form>

<form action="{{ url('download-tracker') }}" id="tracker_form" method="post"
    style="display:none">
    @csrf
    <input type="hidden" name="selected_pipeline_ids"
        id="selected_pipeline_ids_tracker" value=''>
</form>

<script>
    showPipelineData();

    var addCandidateModal = `
    <div class="modal-header custom-modal-header">
                <div class="col-sm-12">
                    <input type="text" id="searchQuery"
                        placeholder="Serach Candidate By Name, Email or Contact Number" class="form-control"
                        onkeyup="getCandidateBySearch()" checked>

                    <div class="m-2 d-flex justify-content-between">
                        <small>Checked Candidates will see you
                            after clicking</small>

                        
                        <a href="javascript::void(0)" ><small style="position:relative;"><input style="position: absolute; top: 2px; right: 114px;"  type="checkbox" id="created_by_me" onclick="getCandidateBySearch()"> Created by <b> Others </b></small></a>

                    </div>
                    <hr>
                    <div id="sel-can-section" class="ccscroll">
                    
                
                    </div> 
                </div>

               
            </div>

            <div class="modal-body custom-modal-body" id="modal-body">

            </div>
    `;
    var cardLoading = `
    <div class="skeleton">
                                <div class="skeleton-left">
                                    <div class="line"></div>
                                    <div class="line  w75"></div>
                                </div>
                                <div class="skeleton-right">
                                    <div class="square circle"></div>
                                </div>
                            </div>
                            <div class="skeleton">
                                <div class="skeleton-left">
                                    <div class="line"></div>
                                    <div class="line  w75"></div>
                                </div>
                                <div class="skeleton-right">
                                    <div class="square circle"></div>
                                </div>
                            </div>
                            <div class="skeleton">
                                <div class="skeleton-left">
                                    <div class="line"></div>
                                    <div class="line  w75"></div>
                                </div>
                                <div class="skeleton-right">
                                    <div class="square circle"></div>
                                </div>
                            </div>
                            <div class="skeleton">
                                <div class="skeleton-left">
                                    <div class="line"></div>
                                    <div class="line  w75"></div>
                                </div>
                                <div class="skeleton-right">
                                    <div class="square circle"></div>
                                </div>
                            </div>
                            <div class="skeleton">
                                <div class="skeleton-left">
                                    <div class="line"></div>
                                    <div class="line  w75"></div>
                                </div>
                                <div class="skeleton-right">
                                    <div class="square circle"></div>
                                </div>
                            </div>
                            <div class="skeleton">
                                <div class="skeleton-left">
                                    <div class="line"></div>
                                    <div class="line  w75"></div>
                                </div>
                                <div class="skeleton-right">
                                    <div class="square circle"></div>
                                </div>
                            </div>
                            <div class="skeleton">
                                <div class="skeleton-left">
                                    <div class="line"></div>
                                    <div class="line  w75"></div>
                                </div>
                                <div class="skeleton-right">
                                    <div class="square circle"></div>
                                </div>
                            </div>
                `;
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    })

    function addCandidate(id) {
        $.get("{{ url('add_candidate_to_pipeline') }}", {
            id: id,
        }, function(response) {
            $('#commonModalBody').html(response);
            $('#rightModal').modal('show');
            // $('#commonModal').modal('show');
        });
    }


    function scheduleInterview(pipeline) {
        $('#modal-section').html('');
        $.get("{{ url('open-schedule-interview-modal') }}" + "/" + pipeline, function(response) {
            $('#modal-section').html(response);
            $('#rightModal').modal('show');
        });

    }

    function showPipelineData() {
        
       
        var user = $('#owners').val();
        if (user == 0) {
            $('.allCandidate').show();
        } else {
            $('.allCandidate').hide();
            $('.pco-user' + user).show();
        }
    }


    $("#setinterview").click(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                alert(data); // show response from the php script.
            }
        });

    });

    function scheduleInterviewSubmit(e) {

        var isValid = $("#setinterview").valid();
        if (!isValid) {
            return false;
        }

        var stages = [
            'sourcing',
            'telephonic',
            'f2f',
            'not_attend',
            'rejected',
            'hot',
            'hold',
            'selected',
            'backout',
            'offered',
            'joined',
        ];
        $.ajax({
            type: "POST",
            url: "{{ url('set-interview') }}",
            data: $('#setinterview').serialize(),
            success: function(result) {
                if (result == 1) {
                    $('#rightModal').modal('hide');
                    $.each(stages, function(index, stage) {
                        $('#' + stage + '_candidate_section').html(cardLoading);
                        getCandidateAccordingStage(stage);
                    });
                }
            }
        });
    }


    function scheduleInterviewBulkSubmit(e) {

        var isValid = $("#setinterview").valid();
        if (!isValid) {
            return false;
        }

        var stages = [
            'sourcing',
            'telephonic',
            'f2f',
            'not_attend',
            'rejected',
            'hot',
            'hold',
            'selected',
            'backout',
            'offered',
            'joined',
        ];
        $.ajax({
            type: "POST",
            url: "{{ url('set-interview-multiple') }}",
            data: $('#setinterview').serialize(),
            success: function(result) {
                if (result == 1) {
                    $('#rightModal').modal('hide');
                    $.each(stages, function(index, stage) {
                        $('#' + stage + '_candidate_section').html(cardLoading);
                        getCandidateAccordingStage(stage);
                    });
                }
            }
        });
    }

    function offerDetailsSubmit(e) {

        var isValid = $("#offerForm").valid();
        if (!isValid) {
            return false;
        }
        var stages = [
            'sourcing',
            'telephonic',
            'f2f',
            'not_attend',
            'rejected',
            'hot',
            'hold',
            'selected',
            'backout',
            'offered',
            'joined',
        ];
        $.ajax({
            type: "POST",
            url: "{{ url('set-offer-detail') }}",
            data: $('#offerForm').serialize(),
            success: function(result) {
                if (result == 1) {
                    $('#rightModal').modal('hide');
                    $.each(stages, function(index, stage) {
                        $('#' + stage + '_candidate_section').html(cardLoading);
                        getCandidateAccordingStage(stage);
                    });
                }

            }
        });
    }





    function getCandidateAccordingStage(stage) {
        var position = "{{ $position->id }}";

        $.ajax({
            type: "get",
            url: "{{ url('get-candidate-accroding-stage') }}",
            data: {
                stage: stage,
                position: position
            },
            success: function(data) {
                setTimeout(function() {
                    $('#' + stage + '_candidate_section').html(data);
                    showPipelineData();
                }, 200);
            }
        });
    }

    function changeStatus(pipeline, stage, previousStage) {
        var position = "{{ $position->id }}";
        var stage = stage;

        if (stage == 'offered') {
            $.get("{{ url('open-offerd-interview-modal') }}" + "/" + pipeline,
                function(response) {
                    $('#modal-section').html(response);
                    $('#rightModal').modal('show');
                });

        } else if (stage == 'joined') {
            $.get("{{ url('open-joined-modal') }}" + "/" + pipeline,
                function(response) {
                    $('#modal-section').html(response);
                    $('#rightModal').modal('show');
                });
        } else {
            $.ajax({
                type: "get",
                url: "{{ url('pipeline-stage-update') }}",
                data: {
                    pipeline: pipeline,
                    stage: stage
                },
                success: function(data) {

                    $('#' + stage + '_candidate_section').html(cardLoading);
                    $('#' + previousStage + '_candidate_section').html(cardLoading);
                    getCandidateAccordingStage(stage);
                    getCandidateAccordingStage(previousStage);
                }
            });
        }




    }


    function showCandidateToAdd() {
        $.get("{{ url('add-candidate-to-pipeline', [$position->id]) }}", function(data) {
            $('#modal-section').html('');
            $('#modal-section').html(addCandidateModal);
            $('#modal-body').html(data);
            $('#rightModal').modal('show');
        });
    }

    function deleteCandidate() {

        var candidates = [];
        var stages = [
            'sourcing',
            'telephonic',
            'f2f',
            'not_attend',
            'rejected',
            'hot',
            'hold',
            'selected',
            'backout',
            'offered',
            'joined',
        ];
        $('.allcanididates:checked').each(function() {
            candidates.push($(this).val());
        });

        $.get("{{ url('remove-candidate-from-pipeline') }}", {
            candidates
        }, function(data) {
            if (data == 1) {

                $.each(stages, function(index, stage) {
                    $('#' + stage + '_candidate_section').html(cardLoading);
                    getCandidateAccordingStage(stage);
                });

            }
        });
    }
</script>


<script
    src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js">
</script>
<script>
    $("#setinterview").validate({
        rules: {
            interview_date: "required",
            interview_time_from: "required",
            interview_time_to: "required",
            interview_venue: "required",
        },
        messages: {
            interview_date: "Please select interview date",
            interview_time_from: "Please select interview time from",
            interview_time_to: "Please select interview time to",
            interview_venue: "Please enter interview venue",
        }
    });

    function generateBatchHeader(pipeline_id, position_id, candidate_id) {
        var loader = document.querySelector('#loader-container');
        loader.style.display = "block";
        $.ajax({
            type: "get",
            url: "{{ url('candidate-batch-header') }}/" + pipeline_id + '/' + position_id + '/' + candidate_id,
            success: function(data) {
                loader.style.display = "none";
                location.reload();
            }
        });
    }

    function bulkBatchHeaderDownload() {
        var selected_pipeline_ids = new Array();
        $(".candidateCard input[type=checkbox]:checked").each(function() {
            selected_pipeline_ids.push(this.value);
        });
        if (selected_pipeline_ids.length == 0) {
            errorMsg("Please select candidates");
            return false;
        }
        $("#selected_pipeline_ids").val(selected_pipeline_ids);
        $("#bulk_batch_header_form").submit();

    }

    function saveJoinedDetails() {

        var isValid = $("#joiningdetailsform").valid();
        if (!isValid) {
            return false;
        }

        var stages = [
            'sourcing',
            'telephonic',
            'f2f',
            'not_attend',
            'rejected',
            'hot',
            'hold',
            'selected',
            'backout',
            'offered',
            'joined',
        ];
        var formData = new FormData();
        $('#joiningdetailsform :input').each(function() {
            var element = $(this);
            var fieldName = element.attr('name');
            var fieldType = element.attr('type');
            if (fieldType === 'file') {
                var file = element[0].files[0];
                formData.append(fieldName, file);
            } else {
                var fieldValue = element.val();
                formData.append(fieldName, fieldValue);
            }
        });
        $.ajax({
            method: 'POST',
            url: "{{ url('saved-joined-details') }}",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                $('#rightModal').modal('hide');
                if (response == 1) {
                    $.each(stages, function(index, stage) {
                        $('#' + stage + '_candidate_section').html(cardLoading);
                        getCandidateAccordingStage(stage);
                    });
                } else {
                    errorMsg('Target Not Assigned!!')
                }

            }

        });
    }


    function downloadTracker(){
        var selected_pipeline_ids = new Array();
        $(".candidateCard input[type=checkbox]:checked").each(function() {
            selected_pipeline_ids.push(this.value);
        });
        if (selected_pipeline_ids.length == 0) {
            errorMsg("Please select candidates");
            return false;
        }

        $("#selected_pipeline_ids_tracker").val(selected_pipeline_ids);
        $("#tracker_form").submit();
    }


    function setBulkInterview(){

        var candidates = [];
        $('.allcanididates:checked').each(function() {
            candidates.push($(this).val());
        });

        if (candidates.length == 0) {
            errorMsg("Please select candidates");
            return false;
        }


        $('#modal-section').html('');
        $.get("{{ url('open-schedule-interview-modal-multiple') }}", { candidates } , function(response) {
            $('#modal-section').html(response);
            $('#rightModal').modal('show');
        });
 
    }
</script>
@endsection