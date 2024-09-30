<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Tailwind CSS -->
</head>

<body>

    <div className="flex min-h-screen w-full items-center justify-center overflow-hidden">
        <Navbar />
        <div className="max-w-[90%] sm:max-w-[32rem] mt-[4rem]">
            <BoxReveal boxColor={"#028E83"} duration={0.8}>
                <p className="text-[2rem] sm:text-[3.5rem] font-bold text-center">
                    <span className="text-[#028E83]"> Bootcam</span>
                    <span className="text-[#FE9900]"> Power BI.</span>
                </p>
            </BoxReveal>

            <BoxReveal boxColor={"#028E83"} duration={0.8}>
                <div className="mt-[1.5rem]">
                    <p className="text-[0.875rem] sm:text-[1rem]">
                        📊 Jadilah ahli dalam
                        <span className="font-semibold text-[#FE9900]"> visualisasi data</span> dan ambil langkah
                        pertama menuju karier yang lebih cerah!
                        <span className="font-semibold text-[#FE9900]"> Daftar sekarang </span>, dan wujudkan impianmu
                        menjadi
                        <span className="font-semibold text-[#FE9900]"> data-driven </span>professional!
                        <br />
                        <br />
                        📝 Temukan lebih banyak informasi dan daftar di Proskill Akademia!
                        <br />
                    </p>
                </div>
            </BoxReveal>
            <BoxReveal boxColor={"#5046e6"} duration={0.9}>
                <ShimmerButton />
            </BoxReveal>
        </div>
        <div className="max-w-[90%] sm:max-w-[32rem]">
            <div className="flex mt-[1.5rem] justify-between items-center">
                <div className="flex-1"></div>
                <BoxReveal boxColor={"#028E83"} duration={0.8}>
                    <Image
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/New_Power_BI_Logo.svg/900px-New_Power_BI_Logo.svg.png?20210102182532"
                        alt="Bootcamp Power BI" width={300} // Ukuran lebih kecil untuk responsif height={300} // Ukuran
                        lebih kecil untuk responsif className="mx-auto" />
                </BoxReveal>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
