@extends('layouts.main')

@section('container')
    <div class="row pt-md-5 pt-3 pb-5 px-2 text-white d-flex align-items-center justify-content-center" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-md-5 col-11 mb-3">
            <h3>Sistem E-Voting Pemilihan Ketua OSIS</h3>
            <h3 class="mb-3">Berbasis Web</h3>
            <a href="/kandidat" class="btn btn-outline-light px-3 rounded-pill" style="margin-right: 0.5rem">Lihat Kandidat</a>
            <a href="/voting" class="btn text-white px-3 rounded-pill" style="background: #03C988">Voting Sekarang</a>
        </div>
        <div class="col-md-5 d-flex pt-5 justify-content-center img-ilustration-beranda">
            <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="60%" viewBox="0 0 914.81679 687.57485" xmlns:xlink="http://www.w3.org/1999/xlink"><title>voting</title><circle cx="772.09812" cy="242.42547" r="21.92017" fill="#03c988" opacity="0.4"/><circle cx="309.93005" cy="112.5011" r="31.2479" fill="#03c988" opacity="0.4"/><circle cx="252.09812" cy="127.42547" r="21.92017" fill="#03c988" opacity="0.4"/><path d="M933.04867,593.76205c-17.32009,18.96224-17.949,46.58449-17.949,46.58449s27.4525-3.12163,44.77258-22.08387,17.949-46.58449,17.949-46.58449S950.36875,574.7998,933.04867,593.76205Z" transform="translate(-142.59161 -106.21258)" fill="#3f3d56"/><path d="M942.83253,599.21845c-5.241,25.14129-27.27179,41.81544-27.27179,41.81544s-13.53351-24.08793-8.29253-49.22921S934.54,549.98924,934.54,549.98924,948.07351,574.07717,942.83253,599.21845Z" transform="translate(-142.59161 -106.21258)" fill="#03c988"/><polygon points="777.746 233.581 777.746 533.289 677.843 615.818 166.746 615.818 166.746 301.631 315.876 233.581 777.746 233.581" fill="#3f3d56"/><polygon points="777.746 233.581 777.746 234.782 741.882 258.788 677.843 301.631 166.746 301.631 315.876 233.581 777.746 233.581" opacity="0.1"/><polygon points="777.746 233.581 777.746 533.289 677.843 615.818 678.567 300.907 741.882 258.788 777.167 233.581 777.746 233.581" opacity="0.1"/><polygon points="643.094 274.845 331.803 274.845 354.969 261.814 653.23 261.814 643.094 274.845" fill="#2f2e41"/><path d="M1054.35223,738.3321s6.03477,25.23633.54862,26.33356-32.36834.74308-38.95173,1.84031-20.29878-.74308-20.29878-5.68062,14.264-8.22924,14.264-8.22924,20.29879-10.97231,20.8474-11.52093S1054.35223,738.3321,1054.35223,738.3321Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path d="M1049.41469,589.65722s-1.64585,18.65294-1.64585,20.29879,1.64585,27.43079,0,28.528,1.09723,8.77785,1.09723,11.52093,8.77786,48.27819,6.58339,65.8339,3.2917,15.90985,1.64585,17.5557-1.64585,1.64585-1.64585,4.93754-17.5557,6.03478-17.5557,6.03478L1018.6922,623.12279l9.87509-36.20865Z" transform="translate(-142.59161 -106.21258)" fill="#575a89"/><path d="M1049.41469,589.65722s-1.64585,18.65294-1.64585,20.29879,1.64585,27.43079,0,28.528,1.09723,8.77785,1.09723,11.52093,8.77786,48.27819,6.58339,65.8339,3.2917,15.90985,1.64585,17.5557-1.64585,1.64585-1.64585,4.93754-17.5557,6.03478-17.5557,6.03478L1018.6922,623.12279l9.87509-36.20865Z" transform="translate(-142.59161 -106.21258)" opacity="0.1"/><path d="M1046.67161,746.01272s5.48616,19.75017,0,20.8474-32.36833-1.25692-38.95172-.15968-20.29879,1.25692-20.29879-3.68063,14.264-8.22923,14.264-8.22923,20.29879-10.97232,20.8474-11.52093S1046.67161,746.01272,1046.67161,746.01272Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path d="M1054.35223,567.71259s6.58339,15.90986-1.09723,24.13909-16.45847,24.68772-16.45847,25.78495,15.36124,110.27177,13.16677,117.40378-1.64584,11.52093-1.09723,12.61816-5.48616,7.132-12.06954,7.132-16.45848-4.93754-17.55571-9.32647,1.64585-42.24342,1.09723-49.37542-3.29169-17.55571-4.38893-19.75017-7.132-4.38893-8.22923-10.97232-9.87509-90.52161-7.132-93.26468S1054.35223,567.71259,1054.35223,567.71259Z" transform="translate(-142.59161 -106.21258)" fill="#575a89"/><circle cx="870.06582" cy="316.66544" r="18.65294" fill="#ffb9b9"/><path d="M1024.17836,432.20449s-3.84031,20.29878-1.09723,22.49324-20.8474,5.48616-20.8474,5.48616-2.74308-26.88217-3.29169-29.62525S1024.17836,432.20449,1024.17836,432.20449Z" transform="translate(-142.59161 -106.21258)" fill="#ffb9b9"/><path d="M998.942,458.538s6.58338-19.20155,33.46556-13.71539c0,0,4.93754,1.64585,3.29169,3.29169s-3.29169,1.64585-1.09723,3.2917,4.93754,0,3.2917,1.64585,14.81262,11.52093,13.71539,30.17387,3.84031,44.98649,0,49.37542,2.74308,23.59048,1.64585,27.43079,6.58339,8.77785,3.29169,10.4237-62.5422,11.52093-64.188,0-.54862-3.2917-2.19447-6.03478-2.19446-7.68062-1.09723-13.71539,3.84031-20.8474,2.74308-26.33356,0-51.56988,3.29169-57.056S998.942,458.538,998.942,458.538Z" transform="translate(-142.59161 -106.21258)" fill="#03c988"/><path d="M1010.463,592.4003s8.22923,31.2711-2.19447,31.2711-9.87508-32.36833-9.87508-32.36833Z" transform="translate(-142.59161 -106.21258)" fill="#ffb9b9"/><path d="M1004.42819,422.878c0,1.591,2.30416,2.60043,5.87566,2.83084h.00549a29.891,29.891,0,0,0,4.54255-.08776c2.2822-.20848,3.22587,1.93659,3.61543,4.76747.63635,4.66873-.25241,11.21371.7735,12.23962,1.41547,1.4154,11.7349-.00549,14.96076-3.21488a2.98113,2.98113,0,0,0,.9491-1.72267,9.16647,9.16647,0,0,1,2.75406-5.11859c1.90368-2.07924,4.61381-4.38344,7.66964-8.04818,5.48616-6.58339,0-7.132-1.64585-12.06955s-4.38893-6.58339-4.38893-9.87509-12.61816-6.03477-23.04186-5.48615-8.22924,13.71539-8.22924,13.71539-.61993,1.591-1.36055,3.64282a57.21447,57.21447,0,0,0-2.43582,7.911A3.98649,3.98649,0,0,0,1004.42819,422.878Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path d="M1006.62266,466.76728s18.65293-1.09723,20.29878,26.33356,1.09723,53.21573,1.09723,53.76435-7.68062,52.66712-14.81262,52.66712-12.61817-1.09724-14.264-3.84031,4.38892-42.24342,4.38892-42.24342,2.74308-41.6948-1.64585-54.86158S996.74757,468.41313,1006.62266,466.76728Z" transform="translate(-142.59161 -106.21258)" opacity="0.1"/><path d="M1003.87958,464.0242s18.65293-1.09723,20.29878,26.33356,1.09723,53.21573,1.09723,53.76435-7.68062,52.66712-14.81262,52.66712-12.61817-1.09723-14.264-3.84031,4.38892-42.24342,4.38892-42.24342,2.74308-41.6948-1.64584-54.86158S994.00449,465.67005,1003.87958,464.0242Z" transform="translate(-142.59161 -106.21258)" fill="#03c988"/><path d="M694.57306,195.85392s-8.12905-23.0323-14-15.80648,9.03228,19.41939,9.03228,19.41939Z" transform="translate(-142.59161 -106.21258)" fill="#a0616a"/><path d="M732.96023,173.27323,728.07,175.08556s-2.33563,10.38124-1.43241,12.1877,1.35485.45161,0,4.06452-5.41936,13.0968-5.871,14.45164-26.1936-8.58066-26.1936-13.54841c0,0-5.41937,6.32259-8.12905,7.67743,0,0,29.80651,21.67746,33.871,24.38715s6.32259,1.35484,9.9355-1.80646,18.96778-29.35489,18.96778-29.35489Z" transform="translate(-142.59161 -106.21258)" fill="#575a89"/><path d="M719.86343,333.59612s.45161,4.96775,1.35484,5.41936,7.67743,11.742,0,14-12.19357,1.35484-14,2.25807-33.41942,2.70968-33.871-2.25807,15.35487-5.871,15.35487-5.871,14.45164-9.48389,16.70971-14.45164S719.86343,333.59612,719.86343,333.59612Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path d="M811.541,342.62839s10.83873,18.51617,8.12905,20.77424-29.09883,10.487-32.96781,10.83873c-4.96775.45161-8.58066-3.61291-4.51613-5.871s12.64518-11.742,12.64518-14.90326v-8.12905Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path d="M821.92814,221.5959s9.48389,11.742-5.41937,30.70974L791.67,283.9186s15.35486,24.38715,15.80648,37.03233,3.61291,9.9355,4.51614,15.35487,4.96775,2.70968,1.80645,6.77421-14.90325,7.67743-18.51616,4.51613a11.196,11.196,0,0,1-3.61291-9.03227c0-1.80646-6.3226-12.19357-6.77421-15.35487s-17.16132-28.90328-17.16132-28.90328-5.41937-15.35487.90322-23.93553,10.50059-20.75047,10.50059-20.75047-18.62963,22.55692-31.72643,27.97629c0,0-4.96775.90323-4.06453,3.1613s0,3.61291-1.35484,5.871-10.83873,28.45166-14,35.22587-1.80646,10.83873-5.41937,13.0968-19.871.45161-19.871-1.80646,2.25807-8.129,3.61291-11.29034,12.19358-39.742,11.29035-46.06461.45161-14.90325,7.22582-18.51616,41.09685-32.9678,42.90331-32.9678S821.92814,221.5959,821.92814,221.5959Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><circle cx="588.56217" cy="25.51219" r="18.96778" fill="#a0616a"/><path d="M746.50864,133.53122s5.871,10.38712,13.0968,11.742-18.96778,22.12907-18.96778,22.12907-6.32259-19.871-11.742-20.77423S746.50864,133.53122,746.50864,133.53122Z" transform="translate(-142.59161 -106.21258)" fill="#a0616a"/><path d="M727.99248,175.98291c0,5.871,17.61293,22.58069,17.61293,22.58069l16.70971,14s.45162,4.96775,2.25807,5.41936,4.06452.45162,2.25807,3.1613-6.32259,8.58066-2.25807,9.48389a33.19905,33.19905,0,0,0,3.69869.35224c1.08394.06324,2.35741.12195,3.7891.17614,3.3419.11742,7.52385.19419,12.05355.16257q1.93071-.00678,3.929-.04515c17.07555-.33871,36.85625-2.30324,35.23944-8.77485-2.70968-10.83873-.90323-14.45164-6.77421-20.32262s-15.35486-26.1936-15.35486-26.1936-18.96778-32.06457-34.77426-32.06457l-3.28325-.8626a7.51865,7.51865,0,0,0-8.20578,3.15228c-3.17034,4.82775-8.16973,12.08067-11.09166,14.42-4.51614,3.61292-5.22068,1.02066-5.22068,1.02066S727.99248,170.11193,727.99248,175.98291Z" transform="translate(-142.59161 -106.21258)" fill="#575a89"/><path d="M768.1861,244.62821s-13.0968,20.32261-4.96775,23.93552,12.64518-21.22584,12.64518-21.22584Z" transform="translate(-142.59161 -106.21258)" fill="#a0616a"/><path d="M743.55383,129.58233c-.728-.09186-.95819-1.01038-1.08072-1.73382-.65615-3.87406-3.54323-7.54771-7.42237-8.1731a10.50968,10.50968,0,0,0-4.42234.3564,16.77941,16.77941,0,0,0-5.67433,2.793,9.35988,9.35988,0,0,1-2.83563,1.78059c-.71175.209-3.73378,1.55256-4.43989,1.77989-1.55246.4998-2.83715,2.12472-4.436,1.803-1.52966-.30781-2.1106-2.15493-2.35645-3.69575-.56011-3.51031,1.44913-8.748,3.44681-11.6883,1.516-2.23127,4.0813-3.51539,6.64622-4.3508a47.75242,47.75242,0,0,1,9.21763-1.83157c4.219-.49827,8.5887-.76263,12.63192.54148s7.72477,4.49426,8.47957,8.675c.15723.87088.18669,1.7629.37937,2.62663.47006,2.10707,1.8642,3.87819,2.67744,5.878a11.3188,11.3188,0,0,1-.3453,9.17585c-1.12613,2.26466-3.08447,4.44091-2.66184,6.93456l-3.48505-2.748a2.53111,2.53111,0,0,1-1.16328-2.96248l.50663-4.36376a3.8395,3.8395,0,0,0-.226-2.35932C745.4412,125.314,744.76757,129.73548,743.55383,129.58233Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path d="M776.31515,213.46686l-4.25417,17.6897c4.29033.15356,9.967.23485,15.98256.11742,1.51748-4.55227,2.96714-9.29874,4.07809-13.7426,4.06452-16.2581-2.70968-41.09685-6.32259-52.83881s-12.64519-14.90326-12.64519-14.90326a41.18516,41.18516,0,0,0-10.38711,5.41937C756.89576,159.2732,776.31515,213.46686,776.31515,213.46686Z" transform="translate(-142.59161 -106.21258)" opacity="0.1"/><path d="M772.70224,212.56363l-4.43036,18.41679c1.08394.06324,2.35741.12195,3.7891.17614,3.3419.11742,7.52385.19419,12.05355.16257,1.63026-4.83676,3.2065-9.94,4.39419-14.691,4.06452-16.25809-2.70968-41.09685-6.32259-52.83881s-11.51615,1.129-11.51615,1.129,3.16129-7.67744-2.70969-3.61291S772.70224,212.56363,772.70224,212.56363Z" transform="translate(-142.59161 -106.21258)" opacity="0.1"/><path d="M771.3474,148.88609s9.03227,3.16129,12.64518,14.90325,10.38712,36.58072,6.32259,52.83881S777.67,253.20887,777.67,253.20887s-8.58066-6.3226-11.742-4.96775l8.58066-35.67749S755.0893,158.37,760.96028,154.30545A41.185,41.185,0,0,1,771.3474,148.88609Z" transform="translate(-142.59161 -106.21258)" fill="#575a89"/><polygon points="635.488 269.199 510.541 8.828 301.62 109.085 378.456 269.199 635.488 269.199" fill="#f2f2f2"/><rect x="495.4802" y="243.49125" width="123.08078" height="7.6395" transform="translate(-194.75884 159.12232) rotate(-25.6354)" fill="#3f3d56"/><rect x="524.85952" y="304.71353" width="123.08078" height="7.6395" transform="translate(-218.35428 177.85945) rotate(-25.6354)" fill="#3f3d56"/><rect x="637.96766" y="186.32584" width="30.55799" height="30.55799" transform="translate(-165.51243 196.25476) rotate(-25.6354)" fill="#3f3d56"/><rect x="667.34698" y="247.54812" width="30.55799" height="30.55799" transform="translate(-189.10786 214.9919) rotate(-25.6354)" fill="#3f3d56"/><polygon points="519.718 55.924 508.372 88.206 493.077 82.83 490.984 88.785 512.214 96.246 525.672 58.017 519.718 55.924" fill="#57b894"/><polygon points="549.097 117.146 537.751 149.428 522.457 144.053 520.364 150.007 541.593 157.468 555.052 119.239 549.097 117.146" fill="#57b894"/><g id="b6a4aa65-5bff-4dd4-a595-827386906092" data-name="woman"><rect x="147.98395" y="611.96674" width="57.72353" height="57.72353" transform="translate(341.06453 1124.36413) rotate(167.94236)" fill="#f2f2f2"/><path id="ac286760-ef31-4470-8aba-995faff60c3b-182" data-name="right hand" d="M209.52991,591.4916s-20.73423,14.81016-13.82282,20.73423,20.73422-17.7722,20.73422-17.7722Z" transform="translate(-142.59161 -106.21258)" fill="#ffb9b9"/><path id="ad0ee0d5-d520-47bd-bca9-706ef112ee3c-183" data-name="left leg" d="M305.30228,614.20052s-3.94938,49.3672-4.93672,56.27861-1.97469,69.11408-3.94938,76.02549-3.94938,23.69625-3.94938,23.69625H280.61868s.98734-30.60766-1.97469-42.45579-1.97469-44.43048-1.97469-44.43048-5.92406-58.2533-2.962-66.15205S305.30228,614.20052,305.30228,614.20052Z" transform="translate(-142.59161 -106.21258)" fill="#ffb9b9"/><path id="a2d865fc-f989-4a0f-bdfe-5d1a04b5cb09-184" data-name="left shoe" d="M289.50477,767.23884s4.93672,2.962,4.93672,4.93672-.98734,6.91141,0,8.8861,7.89876,9.87344,3.94938,11.84813-21.72157,0-21.72157,0,.98734-13.82282,1.97469-14.81016-.98735-10.86079-.98735-10.86079Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path id="a5afd73e-dc2f-49f8-bb76-01b6bc8ff4ec-185" data-name="right leg" d="M229.82555,612.99062s-1.25432,49.509-.9979,56.4859-5.29085,68.93956-4.05254,76.02006,1.44026,23.97991,1.44026,23.97991l11.78267,1.24365s2.23088-30.54222,6.4202-42.014,6.62748-43.97776,6.62748-43.97776,12.006-57.30967,9.88939-65.4757S229.82555,612.99062,229.82555,612.99062Z" transform="translate(-142.59161 -106.21258)" fill="#ffb9b9"/><path id="bae9c969-98bd-41cd-ab49-dced4866e2f9-186" data-name="right shoe" d="M229.472,766.84173s-5.22036,2.42748-5.42764,4.39126.25643,6.97687-.93274,8.837-8.89149,8.98979-5.17121,11.36812,21.60158,2.28,21.60158,2.28.469-13.85009-.40922-14.93562,2.12191-10.69715,2.12191-10.69715Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path id="efa1face-c8d6-4f61-8a17-c81461288bfc-187" data-name="pants" d="M291.47946,540.14971s7.89875.98735,10.86079,17.7722,13.82281,59.24064,4.93672,62.20267-35.54439,8.8861-36.53173,6.91141-2.962-6.91141-2.962-6.91141,2.962,8.8861-.98734,8.8861-42.45579-5.92407-41.46845-8.8861,2.962-24.6836,2.962-24.6836,5.92407-36.53173,11.84813-42.45579a16.19188,16.19188,0,0,0,4.93672-12.83548Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/><path id="ba787e0e-2496-4127-9664-864bc1f1b460-188" data-name="left hand" d="M306.28962,532.251s-12.83547-2.962-14.81016.98734,4.93672,9.87345,7.89875,9.87345,7.89876-2.962,7.89876-2.962Z" transform="translate(-142.59161 -106.21258)" fill="#ffb9b9"/><circle id="af432612-84fe-4a80-a474-ad6710b59c23" data-name="head" cx="137.03973" cy="324.34195" r="17.77219" fill="#ffb9b9"/><path id="fc691572-079c-4ac7-a111-0c7206f484e6-189" data-name="neck" d="M276.6693,443.39s-2.962,13.82281-.98734,13.82281-14.81016,8.8861-14.81016,8.8861l-12.83548-1.97469-3.94937-5.92406s20.73422-13.82282,20.73422-21.72157S276.6693,443.39,276.6693,443.39Z" transform="translate(-142.59161 -106.21258)" fill="#ffb9b9"/><path id="a377c2ac-5aad-4dd5-94e4-d6887260be3a-190" data-name="upper body" d="M267.7832,457.21281s2.962-1.97468,3.94938-1.97468h7.89875c.98735,0,13.82282,2.962,13.82282,2.962l7.89875,44.43048s-13.82282,22.70891-3.94938,40.48111c0,0-2.962-1.97469-16.78484-.98735s-38.50642,3.94938-39.49377,3.94938-.98734-7.89876,0-9.87344-.98734-.98735-.98734-5.92407-2.962-13.82281-2.962-13.82281l-13.82282-50.35455s17.77219-9.87344,20.73423-8.8861,11.84813,3.94938,13.82281,2.962S267.7832,457.21281,267.7832,457.21281Z" transform="translate(-142.59161 -106.21258)" fill="#03c988"/><path id="fd50713a-8150-4e39-832b-91f38638a5e4-191" data-name="left arm" d="M290.49212,459.1875l2.962-.98734s5.92406-.98735,12.83547,4.93672S338.872,486.83314,338.872,486.83314s9.87344,7.89875,6.91141,16.78484-7.89875,30.60767-22.70891,29.62032c0,0-8.8861,11.84813-13.82282,9.87345s-8.88609-9.87345-5.92406-10.86079,10.86078-10.86078,10.86078-10.86078l-9.87344-18.75954h-2.962l-10.86078-5.92406Z" transform="translate(-142.59161 -106.21258)" fill="#03c988"/><path id="a85ddca5-281c-4897-a8aa-82a4133bac02-192" data-name="right arm" d="M231.25147,465.11157l-7.89875.98734s-6.91141,2.962-5.92406,15.7975-5.92407,71.08878-2.962,78.00018c0,0-9.87344,33.5697-7.89876,34.557s13.82282,6.91141,12.83548,2.962,10.86078-31.595,10.86078-31.595,13.82282-14.81016,7.89875-35.54439V513.49142Z" transform="translate(-142.59161 -106.21258)" fill="#03c988"/><path id="eb14ef5a-0bc4-48da-8b11-b0e113a7ef46-193" data-name="hair" d="M294.42253,447.737l-12.55176,2.73445-1.613-6.18045.6202,6.39679L260.62935,455.099l-.89049-3.41192.34233,3.53138-12.9691,2.82538-2.77438-26.632c-2.85224-10.92841,7.55753-22.576,18.48589-25.42826l4.84809-1.26532c8.02653-2.09487,22.61655-.19014,24.71141,7.83633C288.71652,426.54868,282.46607,441.89025,294.42253,447.737Z" transform="translate(-142.59161 -106.21258)" fill="#2f2e41"/></g></svg>
        </div>
    </div>
    <div class="px-md-5 pt-3">
        <div class="row py-md-3 px-2 px-md-5 d-flex justify-content-center">
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="icon-beranda fa-solid fa-person-booth fa-4x" style="color: #03C988;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>{{ count($pemilihs) }}</h1>
                        <h6>Jumlah Pemilih</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="icon-beranda fa-solid fa-user-tie fa-4x" style="color: #3dabff;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>{{ count($kandidats) }}</h1>
                        <h6>Jumlah Kandidat</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="icon-beranda fa-solid fa-file-shield fa-4x" style="color: #6C63FF;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>108</h1>
                        <h6>Pemilih Sudah Memilih</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="icon-beranda fa-solid fa-file-circle-question fa-4x" style="color: #EB455F;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>108</h1>
                        <h6>Pemilih Belum Memilih</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-md-2 pb-5 px-2 d-flex align-items-center justify-content-center">
        <div class="col-md-5 col-8 d-flex pt-5 justify-content-center img-ilustration-beranda">
            <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="70%" viewBox="0 0 630.61163 532.5" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="93.512 510.086 105.746 513.506 124.762 467.944 106.706 462.896 93.512 510.086" fill="#ffb8b8"/><path d="M373.74781,694.69751h39.92574a0,0,0,0,1,0,0v15.42585a0,0,0,0,1,0,0H387.62974a13.88193,13.88193,0,0,1-13.88193-13.88193v-1.54392A0,0,0,0,1,373.74781,694.69751Z" transform="translate(299.05821 1301.13898) rotate(-164.37997)" fill="#2f2e41"/><polygon points="239.451 519.667 252.155 519.666 258.196 470.666 239.447 470.667 239.451 519.667" fill="#ffb8b8"/><path d="M521.4237,699.786h39.92574a0,0,0,0,1,0,0v15.42585a0,0,0,0,1,0,0H535.30563a13.88193,13.88193,0,0,1-13.88193-13.88193V699.786A0,0,0,0,1,521.4237,699.786Z" transform="translate(798.14279 1231.199) rotate(179.99483)" fill="#2f2e41"/><polygon points="145.049 316.237 115.809 387.868 235.206 414.691 236.729 374.615 182.513 316.868 145.049 316.237" fill="#b3b3b3"/><circle cx="481.43241" cy="364.45203" r="27.29263" transform="translate(-400.50986 91.83598) rotate(-28.66321)" fill="#ffb8b8"/><path d="M500.934,496.02344,446.89,473.90039l-4.81176-31.72754A36.45558,36.45558,0,0,1,470.97573,400.917l7.14843-1.43554a36.79131,36.79131,0,0,1,32.94727,9.772,35.12661,35.12661,0,0,1,10.30688,31.60449,30.60008,30.60008,0,0,1-5.78149,13.47021c-16.97778,22.20167-14.79834,40.65772-14.77417,40.8418Z" transform="translate(-284.69418 -183.75)" fill="#03c988"/><path d="M522.93959,578.76465l-27.08471-43.07422,8.53076-78.35449-11.78418-58.60108.62646.01563A26.70383,26.70383,0,0,1,519.265,424.79883l11.46387,57.42383Z" transform="translate(-284.69418 -183.75)" fill="#2f2e41"/><path d="M523.55825,694.15381a4.946,4.946,0,0,1-4.844-3.97022l-11.866-59.00488a92.563,92.563,0,0,0-12.05151-30.52148l-33.48169-54.16162a1.72243,1.72243,0,0,0-3.05517.24414l-55.04712,132.2373a4.9562,4.9562,0,0,1-5.553,2.94434l-14.7052-2.998a4.924,4.924,0,0,1-3.88733-5.67188l11.99609-70.69775a182.47371,182.47371,0,0,1,12.41919-41.88916l40.627-93.89355,59.95507,19.69043,3.9563,41.98242L535.723,595.52246a45.98228,45.98228,0,0,1,3.3877,14.54834l5.11792,77.5249a4.96767,4.96767,0,0,1-4.531,5.2544l-15.73218,1.28711C523.829,694.148,523.693,694.15381,523.55825,694.15381Z" transform="translate(-284.69418 -183.75)" fill="#2f2e41"/><path d="M414.18532,597.97461l-19.00745-18.0415,35.92151-138.51758a58.06061,58.06061,0,0,1,34.16468-39.03076l.70532-.28711-1.91944,84.30468Z" transform="translate(-284.69418 -183.75)" fill="#2f2e41"/><path d="M475.07214,391.64694c-6.7427-5.83628-8.79338-16.7236-4.66183-24.75013s14.01047-12.34744,22.45774-9.82272c7.9559,2.37787,17.00017-5.55377,16.03091-14.05877s-11.54881-14.04517-18.7522-9.81991a30.51075,30.51075,0,0,0-32.52392,6.3346c-8.46306,8.29077-11.67367,21.84425-7.87434,33.24121S464.15309,392.79659,475.07214,391.64694Z" transform="translate(-284.69418 -183.75)" fill="#2f2e41"/><path d="M451.19692,613.46363a4.66266,4.66266,0,0,1-1.03329.26633l-43.39494,6.0576a4.67,4.67,0,0,1-5.02681-2.96278l-37.35282-97.19509a4.69015,4.69015,0,0,1,3.35629-6.26032l.00023-.00009,40.80846-9.10662a3.728,3.728,0,0,0,.90578-.33136l39.692-20.75223a4.64571,4.64571,0,0,1,.96491-.37553l43.68136-11.645a4.681,4.681,0,0,1,5.58631,2.84924l32.56935,84.74813a4.66674,4.66674,0,0,1-.61613,4.48382l-11.26374,15.126a4.68394,4.68394,0,0,1-2.07947,1.57648l-24.61611,9.46016a3.7085,3.7085,0,0,0-.51152.24314l-41.019,23.5089A4.68521,4.68521,0,0,1,451.19692,613.46363Z" transform="translate(-284.69418 -183.75)" fill="#fff"/><path d="M471.38654,484.11523l-5.547,1.47941L451.14,489.51513l-.02617.006-20.12476,10.5228-7.46846,3.90575-.00347.00133-11.21691,5.86409-.30761.0693L400.34017,512.483l-5.63163,1.25917-22.96944,5.1254,36.05914,93.82882,23.66978-3.303,5.80365-.81156,12.37-1.72874.14359-.0185,39.74931-22.78177,24.18458-9.29432,11.042-14.8275-31.38876-81.67614Z" transform="translate(-284.69418 -183.75)" fill="#e6e6e6"/><rect x="375.72439" y="514.49898" width="128.10654" height="5.70851" transform="translate(-441.01291 8.44503) rotate(-21.02215)" fill="#fff"/><rect x="382.55041" y="532.26085" width="128.10654" height="5.70851" transform="translate(-446.93028 12.07592) rotate(-21.02215)" fill="#fff"/><rect x="396.33897" y="568.13981" width="128.10654" height="5.70851" transform="translate(-458.88335 19.41031) rotate(-21.02215)" fill="#fff"/><polygon points="186.692 300.365 222.492 393.519 217.164 395.567 181.145 301.845 186.692 300.365" fill="#fff"/><polygon points="146.295 316.294 138.944 336.748 136.395 343.843 130.449 360.398 129.175 363.937 127.9 367.493 126.221 372.162 114.17 405.7 111.037 397.547 120.863 370.198 123.086 364.006 123.412 363.102 126.041 355.781 129.358 346.548 131.907 339.452 138.823 320.201 138.826 320.2 146.295 316.294" fill="#fff"/><polygon points="205.707 399.97 204.84 400.303 165.091 423.085 164.947 423.103 127.298 326.134 127.606 326.065 138.823 320.201 138.826 320.2 146.295 316.294 166.42 305.771 166.446 305.765 205.707 399.97" opacity="0.1"/><path d="M451.37605,613.93044a5.17988,5.17988,0,0,1-1.14313.29494l-43.39517,6.05769a5.16845,5.16845,0,0,1-5.56259-3.27893l-37.35282-97.19508a5.19044,5.19044,0,0,1,3.71417-6.92776l40.80846-9.10662a3.24307,3.24307,0,0,0,.78321-.28687l39.692-20.75223a5.16094,5.16094,0,0,1,1.06729-.4154l43.682-11.64475a5.17964,5.17964,0,0,1,6.18166,3.153l32.56935,84.74813a5.16511,5.16511,0,0,1-.68184,4.96207L520.475,578.66405a5.18258,5.18258,0,0,1-2.30116,1.74485l-24.61611,9.46016a3.21137,3.21137,0,0,0-.44252.21034L452.0964,613.58822A5.18984,5.18984,0,0,1,451.37605,613.93044ZM367.6219,514.96937a3.19083,3.19083,0,0,0-1.83267,4.12223L403.142,616.28668a3.1767,3.1767,0,0,0,3.41933,2.01544l43.39517-6.05769a3.20364,3.20364,0,0,0,1.14572-.39166l41.019-23.5089a5.20782,5.20782,0,0,1,.719-.34169l24.6161-9.46016a3.18755,3.18755,0,0,0,1.41451-1.07246l11.26369-15.12546a3.1746,3.1746,0,0,0,.41908-3.05012l-32.56936-84.74813a3.184,3.184,0,0,0-3.79956-1.93837L450.50312,484.2526a3.28983,3.28983,0,0,0-.65573.25514l-39.69255,20.75295a5.276,5.276,0,0,1-1.27381.466l-40.80869,9.10671A3.16512,3.16512,0,0,0,367.6219,514.96937Z" transform="translate(-284.69418 -183.75)" fill="#e6e6e6"/><polygon points="115.646 328.733 152.577 424.832 146.774 425.643 110.014 329.992 115.646 328.733" fill="#fff"/><circle cx="126.26773" cy="364.85865" r="2.66397" fill="#3f3d56"/><circle cx="220.72302" cy="367.69825" r="2.66397" fill="#03c988"/><path d="M506.4957,503.33252c3.02346,7.86728-.615,33.93912-1.89456,42.30813a1.52108,1.52108,0,0,1-2.46729.9482c-6.555-5.35812-26.71747-22.28309-29.74092-30.15037a18.26722,18.26722,0,1,1,34.10277-13.106Z" transform="translate(-284.69418 -183.75)" fill="#03c988"/><circle cx="204.75013" cy="326.1355" r="9.89474" fill="#fff"/><path d="M476.73436,488.53547a10.41983,10.41983,0,0,1,14.51564-6.6768l17.6639-15.96738,12.32141,8.36769-25.26156,22.19868a10.47632,10.47632,0,0,1-19.23939-7.92219Z" transform="translate(-284.69418 -183.75)" fill="#ffb8b8"/><path d="M505.1957,493.74707l-13.84619-18.791,31.5664-20.20263-22.62475-32.28418a13.082,13.082,0,0,1,19.53051-17.17188l28.32862,25.84619a23.72945,23.72945,0,0,1-3.32959,37.59766Z" transform="translate(-284.69418 -183.75)" fill="#2f2e41"/><path d="M396.71486,543.05087a10.41988,10.41988,0,0,0,1.44679-15.912l9.15293-21.98169L395.313,496.337l-12.48972,31.22394a10.47632,10.47632,0,0,0,13.8916,15.49Z" transform="translate(-284.69418 -183.75)" fill="#ffb8b8"/><path d="M402.89919,520.73145l-21.64636-5.041,16.13086-46.51514a76.2628,76.2628,0,0,1,12.13354-22.20556l26.31616-33.46436a14.71572,14.71572,0,0,1,23.2002,18.10938l-29.2013,37.68847Z" transform="translate(-284.69418 -183.75)" fill="#2f2e41"/><path d="M666.69418,716.25h-381a1,1,0,1,1,0-2h381a1,1,0,0,1,0,2Z" transform="translate(-284.69418 -183.75)" fill="#ccc"/><path d="M814.48159,715.75h-9V188.25a4.5,4.5,0,0,1,9,0Z" transform="translate(-284.69418 -183.75)" fill="#e6e6e6"/><path d="M879.69418,716.25h-140a1,1,0,0,1,0-2h140a1,1,0,0,1,0,2Z" transform="translate(-284.69418 -183.75)" fill="#ccc"/><path d="M876.93154,252.75h-130.95a4.50507,4.50507,0,0,1-4.5-4.5v-38a4.50507,4.50507,0,0,1,4.5-4.5H876.94106a4.50953,4.50953,0,0,1,2.19287.5708l33.86475,18.89893a4.49979,4.49979,0,0,1,.01733,7.84912l-33.87427,19.10107A4.51272,4.51272,0,0,1,876.93154,252.75Z" transform="translate(-284.69418 -183.75)" fill="#03c988"/><path d="M864.98159,334.75h-130.95a4.51114,4.51114,0,0,1-2.21-.58008l-33.87451-19.10107a4.49978,4.49978,0,0,1,.01734-7.84912l33.86474-18.89893a4.50953,4.50953,0,0,1,2.19287-.5708H864.98159a4.50508,4.50508,0,0,1,4.5,4.5v38A4.50508,4.50508,0,0,1,864.98159,334.75Z" transform="translate(-284.69418 -183.75)" fill="#e6e6e6"/><path d="M865.48159,415.25h-130.95a4.51114,4.51114,0,0,1-2.21-.58008l-33.87451-19.10107a4.49978,4.49978,0,0,1,.01734-7.84912l33.86474-18.89893a4.50953,4.50953,0,0,1,2.19287-.5708H865.48159a4.50508,4.50508,0,0,1,4.5,4.5v38A4.50508,4.50508,0,0,1,865.48159,415.25Z" transform="translate(-284.69418 -183.75)" fill="#e6e6e6"/></svg>
        </div>
        <div class="col-md-5 mt-3 px-4 px-md-5 d-flex align-items-center">
            <div class="px-md-5">
                <h3>Cara Mengikuti Voting</h3>
                <p>Pastikan kamu sudah terdaftar di sistem e-voting ini. Jika belum silahkan hubungi panitia</p>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Login</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Pilih Menu Voting</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Pilih Kandidat</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Pilih Tombol Voting</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Selesai</span></li>
                </ul>
            </div>
        </div>
    </div>
    
@endsection