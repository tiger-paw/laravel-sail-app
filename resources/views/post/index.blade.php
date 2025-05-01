<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>

    <div class="mx-auto px-6">

        {{-- @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif --}}

        <x-message :message="session('message')" />

        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <h1 class="p-4 text-lg font-semibold">
                件名：
                <a href="{{ route('post.show', $post) }}" class="text-blue-600">
                    {{$post->title}}
                </a>
            </h1>
            <hr class="w-full">
            <p class="mt-4 p-4">
                {{$post->body}}
            </p>
            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}} / {{$post->user->name ?? '名無し'}}
                </p>
            </div>
        </div>
        @endforeach
        <div class="mb-4">
            {{ $posts->links() }}
        </div>
    </div>

    {{-- ログイン成功時、紙吹雪アニメーション --}}
    @if(session('login_success'))
    <script>
    window.addEventListener('DOMContentLoaded', function () {
        const duration = 3000; // アニメーション時間
        const animationEnd = Date.now() + duration;
        const colors = ['#bb0000', '#ffffff', '#00bb00', '#0000bb', '#ffff00'];

        function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
        }

        function createParticle(x, y) {
            const particle = document.createElement('div');
            particle.style.position = 'fixed';
            particle.style.left = x + 'px';
            particle.style.top = y + 'px';
            particle.style.width = '8px';
            particle.style.height = '8px';
            particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.borderRadius = '50%';
            particle.style.opacity = '0.8';
            particle.style.zIndex = 9999;
            document.body.appendChild(particle);

            const angle = Math.random() * 2 * Math.PI;
            const speed = Math.random() * 2 + 2; // 2〜4に調整
            const dx = Math.cos(angle) * speed;
            const dy = Math.sin(angle) * speed;

            let lifetime = 0;
            const gravity = 0.2;

            function move() {
                if (lifetime > 200) { // 長めに生存
                    particle.remove();
                    return;
                }
                x += dx;
                y += dy + gravity * lifetime;
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                lifetime++;
                requestAnimationFrame(move);
            }

            move();
        }

        const interval = setInterval(function () {
            const timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
                clearInterval(interval);
                return;
            }

            for (let i = 0; i < 10; i++) {
                const x = randomInRange(0, window.innerWidth); // 画面全体に拡張
                const y = randomInRange(-50, -10); // 高めにスタート
                createParticle(x, y);
            }
        }, 100);
    });
    </script>
    @endif

</x-app-layout>
