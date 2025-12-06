{{-- @extends('frontend.main')

@section('style')
    <style>
        .article-detail-container {
            margin-top: 80px;
            padding: 4rem 0;
            background-color: #f8fafc;
        }

        .article-content-wrapper {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .article-hero-image {
            width: 100%;
            height: 400px;
            overflow: hidden;
            background: #e2e8f0;
        }

        .article-hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-content {
            padding: 3rem;
        }

        .article-header {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .article-detail-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #1a202c;
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        .article-detail-meta {
            display: flex;
            gap: 2rem;
            font-size: 0.95rem;
            color: #718096;
        }

        .article-detail-meta p {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-detail-meta strong {
            color: #2d3748;
        }

        .article-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2d3748;
        }

        .article-body p {
            margin-bottom: 1.5rem;
        }

        .article-body h2,
        .article-body h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #1a202c;
        }

        .article-gallery-section {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 2px solid #e2e8f0;
        }

        .gallery-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            color: #1a202c;
            margin-bottom: 2rem;
            letter-spacing: 0.05em;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 768px) {
            .article-content {
                padding: 2rem 1.5rem;
            }

            .article-hero-image {
                height: 300px;
            }

            .article-detail-meta {
                flex-direction: column;
                gap: 0.5rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }

            .gallery-item img {
                height: 200px;
            }
        }

        @media (max-width: 576px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="article-detail-container">
        <div class="container">
            <div class="article-content-wrapper">
                {{-- Hero Image --}}
                <div class="article-hero-image">
                    <img src="https://placehold.co/900x400/4285f4/ffffff?text=Article+Hero" alt="Lorem Ipsum Article">
                </div>

                {{-- Article Content --}}
                <div class="article-content">
                    {{-- Header --}}
                    <div class="article-header">
                        <h1 class="article-detail-title">Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit</h1>
                        <div class="article-detail-meta">
                            <p><strong>Author:</strong> John Doe</p>
                            <p><strong>Published:</strong> Senin, 15 Januari 2024</p>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="article-body">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                            aliquip ex ea commodo consequat.
                        </p>
                        
                        <p>
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>

                        <h2>Sed Ut Perspiciatis Unde Omnis</h2>
                        
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
                            dicta sunt explicabo.
                        </p>

                        <p>
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur 
                            magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem 
                            ipsum quia dolor sit amet, consectetur, adipisci velit.
                        </p>

                        <h3>At Vero Eos Et Accusamus</h3>
                        
                        <p>
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum 
                            deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.
                        </p>

                        <p>
                            Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. 
                            Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis 
                            est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.
                        </p>
                    </div>

                    {{-- Gallery Section --}}
                    <div class="article-gallery-section">
                        <h2 class="gallery-title">Lorem Ipsum Gallery</h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="https://placehold.co/400x300/34a853/ffffff?text=Gallery+1" alt="Gallery 1">
                            </div>
                            <div class="gallery-item">
                                <img src="https://placehold.co/400x300/fbbc04/ffffff?text=Gallery+2" alt="Gallery 2">
                            </div>
                            <div class="gallery-item">
                                <img src="https://placehold.co/400x300/ea4335/ffffff?text=Gallery+3" alt="Gallery 3">
                            </div>
                            <div class="gallery-item">
                                <img src="https://placehold.co/400x300/9c27b0/ffffff?text=Gallery+4" alt="Gallery 4">
                            </div>
                            <div class="gallery-item">
                                <img src="https://placehold.co/400x300/00bcd4/ffffff?text=Gallery+5" alt="Gallery 5">
                            </div>
                            <div class="gallery-item">
                                <img src="https://placehold.co/400x300/ff5722/ffffff?text=Gallery+6" alt="Gallery 6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}