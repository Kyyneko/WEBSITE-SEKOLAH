@extends('frontend/main')

@section('style')
    <style>
        .section-header {
            margin-top: 80px;
            padding: 4rem 0 3rem;
            background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
            color: #ffffff;
        }

        .section-header h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            text-align: center;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .section-content {
            padding: 4rem 0;
            background-color: #f8fafc;
        }

        .staff-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
        }

        .staff-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .staff-card-image {
            width: 100%;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 1.5rem;
        }

        .staff-card-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .staff-card-body {
            padding: 1.5rem;
            text-align: center;
        }

        .staff-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .staff-position {
            font-size: 1rem;
            font-weight: 600;
            color: rgb(19, 123, 191);
            margin: 0;
        }

        .staff-position.not-assigned {
            color: #718096;
            font-style: italic;
        }

        /* Badge for position type */
        .position-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .badge-admin {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .badge-operator {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-support {
            background-color: #fef3c7;
            color: #a16207;
        }

        .badge-other {
            background-color: #f3e8ff;
            color: #7e22ce;
        }

        /* Grid Layout */
        .staff-grid {
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

            .staff-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .staff-card-image {
                height: 250px;
            }

            .staff-card-image img {
                width: 180px;
                height: 180px;
            }
        }

        @media (max-width: 576px) {
            .staff-grid {
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

        .staff-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .staff-card:nth-child(1) { animation-delay: 0.1s; }
        .staff-card:nth-child(2) { animation-delay: 0.2s; }
        .staff-card:nth-child(3) { animation-delay: 0.3s; }
        .staff-card:nth-child(4) { animation-delay: 0.4s; }
        .staff-card:nth-child(5) { animation-delay: 0.5s; }
        .staff-card:nth-child(6) { animation-delay: 0.6s; }
        .staff-card:nth-child(7) { animation-delay: 0.7s; }
        .staff-card:nth-child(8) { animation-delay: 0.8s; }
    </style>
@endsection

@section('content')
    {{-- Header Section --}}
    <div class="section-header">
        <div class="container">
            <h1>Lorem Ipsum Staff</h1>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="section-content">
        <div class="container">
            <div class="staff-grid">
                @php
                    $dummyStaff = [
                        [
                            'name' => 'Lorem Ipsum',
                            'position' => 'Administrator',
                            'type' => 'admin',
                            'image' => 'https://placehold.co/200x200/4285f4/ffffff?text=LI'
                        ],
                        [
                            'name' => 'Dolor Sit Amet',
                            'position' => 'Operator Consectetur',
                            'type' => 'operator',
                            'image' => 'https://placehold.co/200x200/34a853/ffffff?text=DS'
                        ],
                        [
                            'name' => 'Consectetur Adipiscing',
                            'position' => 'Elit Support',
                            'type' => 'support',
                            'image' => 'https://placehold.co/200x200/fbbc04/ffffff?text=CA'
                        ],
                        [
                            'name' => 'Sed Do Eiusmod',
                            'position' => 'Tempor Administrator',
                            'type' => 'admin',
                            'image' => 'https://placehold.co/200x200/ea4335/ffffff?text=SE'
                        ],
                        [
                            'name' => 'Incididunt Ut',
                            'position' => 'Labore Operator',
                            'type' => 'operator',
                            'image' => 'https://placehold.co/200x200/9c27b0/ffffff?text=IU'
                        ],
                        [
                            'name' => 'Dolore Magna',
                            'position' => 'Aliqua Staff',
                            'type' => 'other',
                            'image' => 'https://placehold.co/200x200/00bcd4/ffffff?text=DM'
                        ],
                        [
                            'name' => 'Ut Enim Ad',
                            'position' => 'Minim Support',
                            'type' => 'support',
                            'image' => 'https://placehold.co/200x200/ff5722/ffffff?text=UE'
                        ],
                        [
                            'name' => 'Veniam Quis',
                            'position' => null,
                            'type' => 'other',
                            'image' => 'https://placehold.co/200x200/795548/ffffff?text=VQ'
                        ]
                    ];
                @endphp

                @foreach ($dummyStaff as $staff)
                    <div class="staff-card">
                        <div class="staff-card-image">
                            <img src="{{ $staff['image'] }}" alt="{{ $staff['name'] }}">
                        </div>
                        <div class="staff-card-body">
                            <p class="staff-name">{{ $staff['name'] }}</p>
                            @if (!empty($staff['position']))
                                <p class="staff-position">{{ $staff['position'] }}</p>
                                <span class="position-badge badge-{{ $staff['type'] }}">
                                    {{ ucfirst($staff['type']) }}
                                </span>
                            @else
                                <p class="staff-position not-assigned">Lorem Ipsum Dolor</p>
                                <span class="position-badge badge-other">Unassigned</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection