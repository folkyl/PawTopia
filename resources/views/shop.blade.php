@extends('layouts.app')
@include('layouts.navbar')

@section('content')
<!-- Custom CSS -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
body {
    background: #fff;
    font-family: 'Poppins', Arial, sans-serif;
    margin: 0;
    padding: 0;
}
.shop-hero {
    background: #FFE0B2;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 32px;
    padding: 36px 48px 36px 48px;
    margin: 140px auto 24px auto;
    max-width: 1200px;
    width: 100%;
    min-height: 180px;
    box-shadow: 0 4px 24px #e6a15d22;
    position: relative;
    overflow: visible;
}
.shop-hero-content h2 {
    font-weight: 700;
    color: #8D5B2D;
    font-size: 2.2rem;
    margin-bottom: 0.5rem;
    letter-spacing: -1px;
}
.shop-hero-content p {
    color: #8D5B2D;
    font-size: 1.13rem;
    font-weight: 400;
}
.shop-hero-img {
    height: 300px;
    margin-left: -48px;
    margin-bottom: -40px;
    position: absolute;
    right: -0px;
    top: -67%;
    transform: none;
    z-index: 10;
}

/* Category Sections */
.category-section {
    max-width: 1200px;
    margin: 0 auto 48px auto;
    padding: 0 24px;
}
.category-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 32px;
}
.category-title {
    background: #8D5B2D;
    color: #fff;
    border-radius: 32px;
    padding: 12px 32px;
    font-weight: 700;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 16px rgba(141, 91, 45, 0.3);
}
.subcategory-tabs {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}
.subcategory-tab {
    background: #fff;
    border: 2px solid #E6A15D;
    border-radius: 20px;
    padding: 8px 20px;
    font-weight: 600;
    font-size: 1rem;
    color: #8D5B2D;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}
.subcategory-tab.active, .subcategory-tab:hover {
    background: #8D5B2D;
    color: #fff;
    border-color: #8D5B2D;
}

/* Product Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 32px;
}
.product-card {
    background: #fff;
    border-radius: 18px;
    border: 1.5px solid #f3e7d7;
    box-shadow: 0 4px 24px #e6a15d11;
    padding: 24px 18px 18px 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    min-height: 320px;
    transition: box-shadow 0.2s, transform 0.2s;
}
.product-card:hover {
    box-shadow: 0 8px 32px #e6a15d44;
    transform: translateY(-4px) scale(1.02);
}
.product-card img {
    width: 110px;
    height: 130px;
    object-fit: contain;
    margin-bottom: 1rem;
    border-radius: 12px;
    background: #fff;
}
.product-info {
    width: 100%;
    text-align: left;
    position: relative;
    margin-bottom: 0.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.product-title {
    font-weight: 700;
    font-size: 1.02rem;
    color: #222;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
    letter-spacing: 0.5px;
    line-height: 1.3;
    min-height: 2.6em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.product-stock {
    font-size: 0.89rem;
    color: #888;
    margin-bottom: 0.5rem;
}
.product-price {
    margin: 0.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: auto;
}
.price-sale {
    color: #E57300;
    font-weight: 700;
    font-size: 1.01rem;
}
.price-original {
    text-decoration: line-through;
    color: #aaa;
    font-size: 0.95rem;
}

@media (max-width: 1100px) {
    .products-grid { grid-template-columns: repeat(2, 1fr);}
    .shop-hero, .category-section { max-width: 100vw; width: 100%; }
}
@media (max-width: 700px) {
    .shop-hero, .category-section { max-width: 100vw; width: 100%; padding: 0 8px;}
    .products-grid { grid-template-columns: 1fr;}
    .shop-hero { flex-direction: column; align-items: flex-start; text-align: center;}
    .shop-hero-img { position: static; transform: none; margin-top: 1rem;}
    .subcategory-tabs { flex-direction: column;}
}
</style>

<div class="shop-hero">
    <div class="shop-hero-content">
        <h2>Pet Supplies Catalog</h2>
        <p>Take a look at the pet products available in our store.</p>
    </div>
    <img src="{{ asset('images/anjingkucing.png') }}" class="shop-hero-img" alt="Dog and Cat">
</div>

<!-- PET FOOD Section -->
<div class="category-section">
    <div class="category-header">
        <div class="category-title">
            <span>🐾</span>
            PET FOOD
        </div>
    </div>
    <div class="subcategory-tabs">
        <div class="subcategory-tab active" data-target="cat-food">
            <span>🐱</span>
            Cat
        </div>
        <div class="subcategory-tab" data-target="dog-food">
            <span>🐕</span>
            Dog
        </div>
    </div>
    
    <!-- Cat Food Products -->
    <div class="products-grid" id="cat-food">
        @foreach([
            ['id'=>1,'img'=>'wiskas.png','name'=>'WHISKAS','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>2,'img'=>'catcois.png','name'=>'CAT CHOIZE','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>3,'img'=>'exel.png','name'=>'EXCEL','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>4,'img'=>'f1.png','name'=>'FELIBITE','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
        ] as $p)
        <div class="product-card">
            <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            <div class="product-info">
                <div class="product-title">{{ $p['name'] }}</div>
                <div class="product-stock">{{ $p['stock'] }}</div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Dog Food Products -->
    <div class="products-grid" id="dog-food" style="display: none;">
        @foreach([
            ['id'=>5,'img'=>'dog1.png','name'=>'PEDIGREE','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>6,'img'=>'dog2.png','name'=>'DOG CHOIZE','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>7,'img'=>'dog3.png','name'=>'SMARTHEART','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>8,'img'=>'dog4.png','name'=>'CANIBITE','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
        ] as $p)
        <div class="product-card">
            <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            <div class="product-info">
                <div class="product-title">{{ $p['name'] }}</div>
                <div class="product-stock">{{ $p['stock'] }}</div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- PET SUPPLIES Section -->
<div class="category-section">
    <div class="category-header">
        <div class="category-title">
            <span>🐾</span>
            PET SUPPLIES
        </div>
    </div>
    
    <div class="subcategory-tabs">
        <div class="subcategory-tab active" data-target="cat-supplies">
            <span>🐱</span>
            Cat
        </div>
        <div class="subcategory-tab" data-target="dog-supplies">
            <span>🐕</span>
            Dog
        </div>
    </div>
    
    <!-- Cat Supplies Products -->
    <div class="products-grid" id="cat-supplies">
        @foreach([
            ['id'=>9,'img'=>'scop.png','name'=>'Litter scoop','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>10,'img'=>'eat.png','name'=>'food place','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>11,'img'=>'kan.png','name'=>'pet carrier cage','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>12,'img'=>'main.png','name'=>'feather toy','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
        ] as $p)
        <div class="product-card">
            <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            <div class="product-info">
                <div class="product-title">{{ $p['name'] }}</div>
                <div class="product-stock">{{ $p['stock'] }}</div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Dog Supplies Products -->
    <div class="products-grid" id="dog-supplies" style="display: none;">
        @foreach([
            ['id'=>13,'img'=>'psr.png','name'=>'animal sandbox','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>14,'img'=>'drink.png','name'=>'cat drinking place','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>15,'img'=>'kuku.png','name'=>'Pet Nail Clippers','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>16,'img'=>'scat.png','name'=>'Cleaning Brush for Cats','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
        ] as $p)
        <div class="product-card">
            <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            <div class="product-info">
                <div class="product-title">{{ $p['name'] }}</div>
                <div class="product-stock">{{ $p['stock'] }}</div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- PET VITAMINS Section -->
<div class="category-section">
    <div class="category-header">
        <div class="category-title">
            <span>🐾</span>
            PET VITAMINS
        </div>
    </div>
    
    <div class="subcategory-tabs">
        <div class="subcategory-tab active" data-target="cat-vitamins">
            <span>🐱</span>
            Cat
        </div>
        <div class="subcategory-tab" data-target="dog-vitamins">
            <span>🐕</span>
            Dog
        </div>
    </div>
    
    <!-- Cat Vitamins Products -->
    <div class="products-grid" id="cat-vitamins">
        @foreach([
            ['id'=>17,'img'=>'fera.png','name'=>'FERA PETS MULTIVITAMIN','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>18,'img'=>'zesty.png','name'=>'ZESTY PAWS CAT MULTIVITAMIN','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>19,'img'=>'tomlyn.png','name'=>'TOMLYN CAT IMMUNE SUPPORT','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>20,'img'=>'gimcat.png','name'=>'GIMCAT MULTIVITAMIN','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
        ] as $p)
        <div class="product-card">
            <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            <div class="product-info">
                <div class="product-title">{{ $p['name'] }}</div>
                <div class="product-stock">{{ $p['stock'] }}</div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Dog Vitamins Products -->
    <div class="products-grid" id="dog-vitamins" style="display: none;">
        @foreach([
            ['id'=>21,'img'=>'Nutrition.png','name'=>'NUTRITION STRENGTH DOG MULTIVITAMIN','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>22,'img'=>'zestydog.png','name'=>'ZESTY PAWS COLLAGEN','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>23,'img'=>'multi.png','name'=>'MULTIVITAMIN DOG','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
            ['id'=>24,'img'=>'ultracal.png','name'=>'ULTRACAL SUPLEMEN VITAMIN','stock'=>'1000+ Sold','price'=>1000,'sale'=>200],
        ] as $p)
        <div class="product-card">
            <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            <div class="product-info">
                <div class="product-title">{{ $p['name'] }}</div>
                <div class="product-stock">{{ $p['stock'] }}</div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include ('layouts.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.subcategory-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs in this section
            const parentSection = this.closest('.category-section');
            const allTabs = parentSection.querySelectorAll('.subcategory-tab');
            allTabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Hide all product grids in this section
            const allGrids = parentSection.querySelectorAll('.products-grid');
            allGrids.forEach(grid => grid.style.display = 'none');
            
            // Show the target grid
            const targetId = this.getAttribute('data-target');
            const targetGrid = parentSection.querySelector('#' + targetId);
            if (targetGrid) {
                targetGrid.style.display = 'grid';
            }
        });
    });
});
</script>

@endsection