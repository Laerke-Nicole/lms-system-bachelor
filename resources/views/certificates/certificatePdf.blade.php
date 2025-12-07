<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
{{--    inline css is needed for it to show in the pdf --}}
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 40px;
            background: #f8f9fa;
        }

        .certificate-container {
            background: #fff;
            border: 2px solid #e5e5e5;
            padding: 60px 40px;
            max-width: 750px;
            margin: 0 auto;
            text-align: center;
        }

        .certificate__image {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .certificate__title {
            font-size: 42px;
            margin-top: 10px;
            margin-bottom: 0;
            font-weight: 600;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .certificate__subtitle {
            font-size: 14px;
            margin-top: 2px;
            letter-spacing: 1.5px;
            margin-bottom: 40px;
            color: #559cbe;
            text-transform: uppercase;
        }

        .certificate__presented {
            margin-bottom: 6px;
            font-size: 14px;
            color: #777;
        }

        .certificate__recipient {
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 20px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .certificate__training {
            max-width: 520px;
            margin: 0 auto 60px;
            font-size: 15px;
            line-height: 1.6;
            color: #555;
        }

        .certificate__signature-block {
            max-width: 300px;
            margin: 0 auto 60px;
        }

        .certificate__signature-line {
            width: 100%;
            height: 1px;
            background: #333;
            margin-bottom: 8px;
        }

        .certificate__verified-name {
            font-weight: 500;
            margin-bottom: 2px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .certificate__verified-label {
            font-size: 13px;
            color: #666;
        }

        .certificate__valid-until {
            font-size: 11px;
            margin-top: 30px;
            color: #666;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
<div class="certificate-container">

    <div class="certificate__logo">
        <img src="{{ asset('storage/' . $abInventech->logo) }}" alt="{{ basename($abInventech->logo) }}" class="certificate__image">
    </div>

    <h1 class="certificate__title">Certificate</h1>
    <p class="certificate__subtitle">OF COMPLETION</p>

    <p class="certificate__presented">presented to</p>

    <h2 class="certificate__recipient">
        {{ $certificate->user->first_name }} {{ $certificate->user->last_name }}
    </h2>

    <p class="certificate__training">
        for completing the training
        {{ $certificate->training->course->title }}
        on {{ $certificate->training->trainingSlot->training_date->format('d M Y') }}.
    </p>

    <div class="certificate__signature-block">
        <div class="certificate__signature-line"></div>
        <p class="certificate__verified-name">{{ $trainingUser->signature }}</p>
        <p class="certificate__verified-label">Participant</p>
    </div>

    <p class="certificate__valid-until">Certificate is valid until {{ $certificate->valid_until->format('d M Y') }}.</p>

</div>
</body>
</html>
