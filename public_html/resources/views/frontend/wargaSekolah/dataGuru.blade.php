@extends('frontend/main')

@section('style')
    <style>
        .section-header {
            margin-top: 70px;
            padding: 4rem 0 3rem;
            background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
            color: #ffffff;
        }

        .section-header h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            text-align: center;
            margin: 10;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .section-content {
            padding: 4rem 0;
            background-color: #f8fafc;
        }

        .teacher-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
        }

        .teacher-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .teacher-card-image {
            width: 100%;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 1.5rem;
        }

        .teacher-card-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .teacher-card-body {
            padding: 1.5rem;
            text-align: center;
        }

        .teacher-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .teacher-subject {
            font-size: 1rem;
            font-weight: 600;
            color: rgb(19, 123, 191);
            margin: 0;
        }

        .teacher-subject.not-assigned {
            color: #718096;
            font-style: italic;
        }

        /* Grid Layout */
        .teachers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }

        @media (max-width: 768px) {
            .section-header {
                padding: 3rem 0 2rem;
            }

            .section-content {
                padding: 3rem 0;
            }

            .teachers-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .teacher-card-image {
                height: 250px;
            }

            .teacher-card-image img {
                width: 180px;
                height: 180px;
            }
        }

        @media (max-width: 576px) {
            .teachers-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .teacher-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .teacher-card:nth-child(1) { animation-delay: 0.1s; }
        .teacher-card:nth-child(2) { animation-delay: 0.2s; }
        .teacher-card:nth-child(3) { animation-delay: 0.3s; }
        .teacher-card:nth-child(4) { animation-delay: 0.4s; }
        .teacher-card:nth-child(5) { animation-delay: 0.5s; }
        .teacher-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
@endsection

@section('content')
    {{-- Header Section --}}
    <div class="section-header">
        <div class="container">
            <h1>Lorem Ipsum Dolor</h1>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="section-content">
        <div class="container">
            <div class="teachers-grid">
                @php
                    $dummyTeachers = [
                        [
                            'name' => 'Lorem Ipsum',
                            'subject' => 'Dolor Sit Amet',
                            'image' => 'https://placehold.co/200x200/4285f4/ffffff?text=LI'
                        ],
                        [
                            'name' => 'Consectetur Adipiscing',
                            'subject' => 'Elit Sed Do',
                            'image' => 'https://placehold.co/200x200/34a853/ffffff?text=CA'
                        ],
                        [
                            'name' => 'Eiusmod Tempor',
                            'subject' => 'Incididunt Ut',
                            'image' => 'https://placehold.co/200x200/fbbc04/ffffff?text=ET'
                        ],
                        [
                            'name' => 'Labore Et Dolore',
                            'subject' => 'Magna Aliqua',
                            'image' => 'https://placehold.co/200x200/ea4335/ffffff?text=LD'
                        ],
                        [
                            'name' => 'Ut Enim',
                            'subject' => 'Ad Minim Veniam',
                            'image' => 'https://placehold.co/200x200/9c27b0/ffffff?text=UE'
                        ],
                        [
                            'name' => 'Quis Nostrud',
                            'subject' => 'Exercitation Ullamco',
                            'image' => 'https://placehold.co/200x200/00bcd4/ffffff?text=QN'
                        ],
                        [
                            'name' => 'Laboris Nisi',
                            'subject' => 'Ut Aliquip',
                            'image' => 'https://placehold.co/200x200/ff5722/ffffff?text=LN'
                        ],
                        [
                            'name' => 'Ex Ea Commodo',
                            'subject' => 'Consequat Duis',
                            'image' => 'https://placehold.co/200x200/795548/ffffff?text=EC'
                        ],
                        [
                            'name' => 'Aute Irure',
                            'subject' => 'Dolor In Reprehenderit',
                            'image' => 'https://placehold.co/200x200/607d8b/ffffff?text=AI'
                        ],
                        [
                            'name' => 'Voluptate Velit',
                            'subject' => 'Esse Cillum',
                            'image' => 'https://placehold.co/200x200/3f51b5/ffffff?text=VV'
                        ],
                        [
                            'name' => 'Dolore Eu Fugiat',
                            'subject' => 'Nulla Pariatur',
                            'image' => 'https://placehold.co/200x200/009688/ffffff?text=DF'
                        ],
                        [
                            'name' => 'Excepteur Sint',
                            'subject' => null,
                            'image' => 'https://placehold.co/200x200/cddc39/ffffff?text=ES'
                        ]
                    ];
                @endphp

                @foreach ($dummyTeachers as $teacher)
                    <div class="teacher-card">
                        <div class="teacher-card-image">
                            <img src="{{ $teacher['image'] }}" alt="{{ $teacher['name'] }}">
                        </div>
                        <div class="teacher-card-body">
                            <p class="teacher-name">{{ $teacher['name'] }}</p>
                            @if (!empty($teacher['subject']))
                                <p class="teacher-subject">{{ $teacher['subject'] }}</p>
                            @else
                                <p class="teacher-subject not-assigned">Lorem Ipsum</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection