	@extends('layouts/frontLayout/front_design')

	@php
		$achievements = $achievements ?? [];

		$achievementSchemaItems = [];
		foreach ($achievements as $i => $item) {
			$schemaItem = [
				'@type' => 'ListItem',
				'position' => $i + 1,
				'item' => [
					'@type' => match ($item['type']) {
						'certification' => 'EducationalOccupationalCredential',
						'award' => 'Award',
						'patent' => 'Patent',
						default => 'CreativeWork',
					},
					'name' => $item['title'],
					'description' => $item['description'],
					'image' => asset($item['image']),
				],
			];
			if ($item['type'] === 'certification') {
				$schemaItem['item']['credentialCategory'] = 'certification';
			}
			if ($item['type'] === 'patent' || $item['type'] === 'design_registration') {
				$schemaItem['item']['holder'] = [
					'@type' => 'Organization',
					'name' => 'Autodynamic Technologies & Solutions Pvt. Ltd.',
				];
			}
			if (!empty($item['identifier'])) {
				$schemaItem['item']['identifier'] = $item['identifier'];
			}
			$achievementSchemaItems[] = $schemaItem;
		}

		$achievementsSchema = [
			'@context' => 'https://schema.org',
			'@type' => 'ItemList',
			'name' => 'Awards, Certifications and Intellectual Property Rights',
			'description' => 'Supplier awards, patents, and registered industrial designs held by Autodynamic Technologies & Solutions Pvt. Ltd.',
			'url' => url('/') . '#awards-certifications-ipr',
			'numberOfItems' => count($achievements),
			'itemListElement' => $achievementSchemaItems,
		];

		$organizationSchema = [
			'@context' => 'https://schema.org',
			'@type' => 'Organization',
			'name' => 'Autodynamic Technologies & Solutions Pvt. Ltd.',
			'url' => url('/'),
			'description' => 'Automotive lightweighting, injection molding, and composite manufacturing with IATF certification and registered IPR.',
			'hasCredential' => array_values(array_map(function ($item) {
				return [
					'@type' => 'EducationalOccupationalCredential',
					'name' => $item['title'],
					'description' => $item['description'],
				];
			}, array_filter($achievements, fn ($a) => $a['type'] === 'certification'))),
			'award' => array_values(array_map(function ($item) {
				return $item['title'];
			}, array_filter($achievements, fn ($a) => $a['type'] === 'award'))),
		];
	@endphp

	@section('head_seo')
		<script type="application/ld+json">{!! json_encode($achievementsSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
		<script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
	@endsection

	@section('content')

	@section('styles')
	<style>
		/* Home: prevent horizontal scroll; sections use full width */
		.main.page-wraper {
			overflow-x: hidden;
			width: 100%;
			max-width: 100vw;
		}

		.hero-palette {
			width: 100%;
			max-width: 100%;
			overflow-x: hidden;
		}

		.optimise-section {
			position: relative;
			background: #000;
			color: #e9f3ff;
			padding: 64px 0;
			overflow: hidden;
		}

		.optimise-section::before {
			content: "";
			position: absolute;
			inset: 0;
			background:
				radial-gradient(700px 300px at 15% 15%, rgba(74, 134, 228, 0.15) 0%, rgba(74, 134, 228, 0) 65%),
				radial-gradient(650px 340px at 85% 80%, rgba(60, 112, 210, 0.12) 0%, rgba(60, 112, 210, 0) 70%);
			pointer-events: none;
		}

		.optimise-section .container {
			position: relative;
			z-index: 2;
		}

		.optimise-eyebrow {
			display: inline-flex;
			align-items: center;
			gap: 10px;
			font-size: 11px;
			letter-spacing: 0.26em;
			text-transform: uppercase;
			color: #9fc7ff;
			margin-bottom: 18px;
		}

		.optimise-eyebrow-dot {
			width: 7px;
			height: 7px;
			border-radius: 50%;
			background: #7eb8ff;
			box-shadow: 0 0 10px rgba(126, 184, 255, 0.9);
		}

		.optimise-title {
			font-size: clamp(1.55rem, 3vw, 2.35rem);
			line-height: 1.15;
			margin-bottom: 16px;
			color: #f5f9ff;
		}

		.optimise-title strong {
			background: linear-gradient(95deg, #85bdff 0%, #ffffff 48%, #cbe2ff 100%);
			-webkit-background-clip: text;
			background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.optimise-subtitle {
			max-width: 760px;
			color: #b8c9df;
			font-size: 1rem;
			line-height: 1.75;
			margin: 0 auto 24px;
		}

		.optimise-tags {
			display: flex;
			flex-wrap: wrap;
			gap: 10px;
			margin: 0 auto 22px;
			justify-content: center;
		}

		.optimise-tag {
			display: inline-flex;
			align-items: center;
			padding: 8px 14px;
			border-radius: 999px;
			font-size: 0.82rem;
			color: #c8dcf7;
			border: 1px solid rgba(132, 173, 237, 0.34);
			background: rgba(8, 18, 33, 0.65);
		}

		.optimise-tag.active {
			border-color: rgba(165, 206, 255, 0.7);
			background: rgba(26, 50, 85, 0.7);
			color: #e7f3ff;
		}

		.optimise-visual {
			height: 380px;
			max-width: 1100px;
			margin: 26px auto 0;
			border-radius: 22px;
			border: 1px solid rgba(122, 166, 232, 0.22);
			background:
				radial-gradient(260px 180px at 18% 40%, rgba(130, 145, 170, 0.18) 0%, rgba(130, 145, 170, 0) 72%),
				radial-gradient(260px 200px at 84% 42%, rgba(78, 145, 230, 0.2) 0%, rgba(78, 145, 230, 0) 74%),
				repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.02) 0px, rgba(255, 255, 255, 0.02) 1px, rgba(255, 255, 255, 0) 1px, rgba(255, 255, 255, 0) 26px),
				linear-gradient(160deg, rgba(10, 17, 31, 0.95) 0%, rgba(5, 10, 20, 0.98) 100%);
			box-shadow: inset 0 0 0 1px rgba(156, 193, 248, 0.06), 0 16px 38px rgba(1, 8, 20, 0.55);
			position: relative;
			overflow: hidden;
		}

		.optimise-visual::before {
			content: "";
			position: absolute;
			inset: 0;
			background: linear-gradient(110deg, rgba(110, 170, 250, 0) 0%, rgba(110, 170, 250, 0.12) 50%, rgba(110, 170, 250, 0) 100%);
			transform: translateX(-120%);
			animation: optimiseSweep 5s linear infinite;
		}

		.optimise-product-title {
			position: absolute;
			top: 12px;
			left: 50%;
			transform: translateX(-50%);
			font-size: 1rem;
			font-weight: 500;
			color: #e8f4ff;
			z-index: 3;
		}

		.optimise-line {
			position: absolute;
			height: 3px;
			border-radius: 999px;
			opacity: 0.9;
		}

		.optimise-line.l1 {
			width: 0%;
			left: 11%;
			top: 50%;
			background: linear-gradient(90deg, rgba(100, 170, 255, 0.08), rgba(132, 190, 255, 0.35), rgba(100, 170, 255, 0.08));
		}

		.optimise-line.l2 {
			width: 0;
			left: 29%;
			top: 50%;
			background: linear-gradient(90deg, rgba(132, 190, 255, 0), rgba(160, 210, 255, 0.95), rgba(132, 190, 255, 0));
		}

		.optimise-line.l2::after {
			content: "";
			position: absolute;
			right: -8px;
			top: -3px;
			border-left: 10px solid #b9ddff;
			border-top: 5px solid transparent;
			border-bottom: 5px solid transparent;
		}

		.optimise-part-wrap {
			position: absolute;
			width: 240px;
			height: 128px;
		}

		.optimise-part-wrap.metal {
			left: 8%;
			top: 30%;
		}

		.optimise-part-wrap.plastic {
			left: 66%;
			top: 30%;
		}

		.optimise-part {
			position: relative;
			width: 100%;
			height: 100%;
			border-radius: 16px;
			overflow: hidden;
			display: block;
			clip-path: polygon(8% 0, 88% 0, 100% 26%, 92% 100%, 12% 100%, 0 72%);
			background-position: center center;
			background-size: contain;
			background-repeat: no-repeat;
		}

		.optimise-part-label {
			position: absolute;
			left: 50%;
			bottom: -30px;
			transform: translateX(-50%);
			padding: 0 15px;
			border-radius: 999px;
			font-size: 0.58rem;
			font-weight: 700;
			letter-spacing: 0.1em;
			text-transform: uppercase;
			color: #e7f2ff;
			background: rgba(2, 10, 20, 0.62);
			border: 1px solid rgba(149, 190, 245, 0.35);
			white-space: nowrap;
		}

		.optimise-result {
			display: flex;
			justify-content: center;
			gap: 30px;
			flex-wrap: wrap;
		}

		.optimise-result.in-frame {
			position: absolute;
			left: 50%;
			bottom: 14px;
			transform: translateX(-50%);
			width: 84%;
			padding: 10px 12px;
			border-radius: 12px;
			border: 1px solid rgba(132, 173, 237, 0.25);
			background: rgba(6, 14, 28, 0.55);
		}

		.optimise-result-item {
			text-align: center;
			min-width: 170px;
		}

		.optimise-result-title {
			font-size: 0.95rem;
			color: #c8dcf7;
			letter-spacing: 0.02em;
			margin-bottom: 4px;
		}

		.optimise-result-value {
			font-size: 1rem;
			font-weight: 700;
			color: #eef6ff;
		}

		.optimise-reveal {
			opacity: 0;
			transform: translateY(30px);
		}


		@keyframes optimiseSweep {
			0% {
				transform: translateX(-120%);
			}
			100% {
				transform: translateX(120%);
			}
		}

		@media (max-width: 991px) {
			.optimise-section {
				padding: 48px 0;
			}

			.optimise-visual {
				margin-top: 10px;
				border-radius: 16px;
			}


			.optimise-part-wrap {
				width: 150px;
				height: 96px;
			}

			.optimise-part-wrap.plastic {
				left: 58%;
			}

			.optimise-line.l1,
			.optimise-line.l2 {
				width: 36%;
				left: 32%;
			}

			.optimise-subtitle {
				padding: 0 12px;
			}

			.optimise-tags {
				padding: 0 8px;
			}
		}

		@media (max-width: 575px) {
			.optimise-section {
				padding: 36px 0;
			}

			.optimise-title {
				font-size: clamp(1.35rem, 6.5vw, 1.85rem);
				padding: 0 4px;
			}

			.optimise-tag {
				font-size: 0.75rem;
				padding: 7px 12px;
			}

			.optimise-visual {
				margin-left: 0;
				margin-right: 0;
				border-radius: 14px;
			}


			.optimise-product-title {
				font-size: 0.9rem;
				top: 8px;
			}

			.optimise-part-wrap {
				width: min(38vw, 120px);
				height: 72px;
			}

			.optimise-part-wrap.metal {
				left: 5%;
				top: 28%;
			}

			.optimise-part-wrap.plastic {
				left: auto;
				right: 4%;
				top: 28%;
			}

			.optimise-line.l1,
			.optimise-line.l2 {
				width: 44%;
				left: 28%;
			}

			.optimise-result-item {
				min-width: 0;
			}
		}

		.fss-process-section {
			position: relative;
			background: #000;
			padding: 40px 0;
			overflow: hidden;
		}

		.fss-process-section::before {
			content: "";
			position: absolute;
			inset: 0;
			/*background:
				radial-gradient(1000px 320px at 50% 0%, rgba(80, 141, 232, 0.2) 0%, rgba(80, 141, 232, 0) 70%),
				linear-gradient(180deg, rgba(22, 38, 68, 0.22) 0%, rgba(22, 38, 68, 0) 40%);*/
			pointer-events: none;
		}

		.fss-process-title {
			text-align: center;
			color: #eef5ff;
			font-size: clamp(1.55rem, 3vw, 2.35rem);
			margin-bottom: 24px;
		}

		.fss-process-title strong {
			background: linear-gradient(90deg, #87beff 0%, #ffffff 48%, #cfe5ff 100%);
			-webkit-background-clip: text;
			background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.fss-process-frame {
			position: relative;
			max-width: 1250px;
			margin: 0 auto;
			border-radius: 16px;
			/*border: 1px solid rgba(134, 178, 239, 0.28);*/
			overflow: hidden;
			/*background: radial-gradient(ellipse at center, rgba(16, 33, 61, 0.55) 0%, rgba(8, 17, 31, 0.96) 70%);*/
			/*box-shadow: inset 0 0 0 1px rgba(170, 210, 255, 0.08), 0 24px 56px rgba(3, 10, 22, 0.68);*/
			padding: 26px 22px 20px;
		}

		.fss-process-grid {
			display: grid;
			grid-template-columns: 1.15fr 0.85fr;
			gap: 24px;
			align-items: center;
		}

		.fss-mobile-nav {
			display: none;
			flex-wrap: nowrap;
			gap: 8px;
			overflow-x: auto;
			padding: 2px 2px 14px;
			margin: 0 -2px;
			-webkit-overflow-scrolling: touch;
			scrollbar-width: none;
		}

		.fss-mobile-nav::-webkit-scrollbar {
			display: none;
		}

		.fss-mobile-step {
			flex: 0 0 auto;
			border: 1px solid rgba(120, 224, 255, 0.45);
			background: linear-gradient(162deg, rgba(30, 120, 180, 0.85) 0%, rgba(22, 91, 140, 0.92) 100%);
			color: #eaf5ff;
			border-radius: 999px;
			padding: 9px 14px;
			font-size: 0.72rem;
			font-weight: 600;
			line-height: 1.25;
			white-space: nowrap;
			cursor: pointer;
			transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.2s ease;
		}

		.fss-mobile-step.active {
			border-color: rgba(200, 235, 255, 0.85);
			box-shadow: 0 0 0 1px rgba(175, 218, 255, 0.35), 0 0 18px rgba(87, 165, 246, 0.35);
		}

		.fss-circle-wrap {
			position: relative;
			width: 100%;
			aspect-ratio: 1 / 1;
			max-width: 620px;
			margin: 0 auto;
			container-type: inline-size;
			container-name: fss-orbit;
			--orbit-r: 41cqw;
			--fss-step-w: 156px;
			--fss-step-h: 74px;
		}

		@keyframes fss-face-glow {
			0%, 100% {
				box-shadow:
					0 8px 22px rgba(5, 18, 35, 0.52),
					0 0 0 1px rgba(100, 160, 230, 0.12);
			}
			50% {
				box-shadow:
					0 12px 30px rgba(5, 22, 42, 0.58),
					0 0 0 1px rgba(140, 200, 255, 0.22),
					0 0 24px rgba(72, 150, 240, 0.18);
			}
		}

		@keyframes fss-face-sheen {
			0% { background-position: 0% 50%; }
			100% { background-position: 200% 50%; }
		}

		@keyframes fss-float {
			0%, 100% { transform: rotate(var(--step-tilt, 0deg)) translateY(0); }
			50% { transform: rotate(var(--step-tilt, 0deg)) translateY(-4px); }
		}

		@keyframes fss-face-glow-active {
			0%, 100% {
				box-shadow:
					0 0 0 1px rgba(175, 218, 255, 0.5),
					0 0 28px rgba(87, 165, 246, 0.45),
					0 10px 26px rgba(5, 18, 35, 0.55);
			}
			50% {
				box-shadow:
					0 0 0 1px rgba(210, 240, 255, 0.65),
					0 0 42px rgba(100, 185, 255, 0.55),
					0 14px 32px rgba(5, 18, 35, 0.58);
			}
		}

		@media (prefers-reduced-motion: reduce) {
			.fss-step-face {
				animation: none !important;
			}
			.fss-orbit-dot-shape {
				box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.65), 0 0 10px rgba(255, 55, 55, 0.45);
			}
		}

		.fss-loop-title {
			position: absolute;
			top: 2%;
			left: 50%;
			transform: translateX(-50%);
			font-size: 1rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			text-transform: uppercase;
			color: #bcdcff;
			z-index: 3;
			white-space: nowrap;
		}

		.fss-orbit {
			position: absolute;
			inset: 8%;
			border-radius: 999px;
			border: 1px dashed rgba(140, 190, 250, 0.35);
			transform-origin: 50% 50%;
			will-change: transform;
			z-index: 1;
			pointer-events: none;
		}

		/* Progress marker: GSAP rotates .fss-orbit-dot-spin — clear cue on auto step change */
		.fss-orbit-dot {
			position: absolute;
			left: 50%;
			top: 50%;
			width: 0;
			height: 0;
			pointer-events: none;
			z-index: 2;
			opacity: 0;
			transform: translate(-50%, -50%);
		}

		.fss-orbit-dot-spin {
			display: block;
			position: absolute;
			left: 0;
			top: 0;
			width: 0;
			height: 0;
			transform: rotate(0deg);
			transform-origin: 0px 0px;
		}

		.fss-orbit-dot-arm {
			display: block;
			position: absolute;
			left: 0;
			top: 0;
			width: 0;
			height: 0;
			transform: translateY(calc(-1 * var(--orbit-r)));
		}

		/* Ring marker: stroke centered on dashed orbit line */
		.fss-orbit-dot-shape {
			position: absolute;
			left: -8px;
			top: -8px;
			width: 16px;
			height: 16px;
			box-sizing: border-box;
			border-radius: 50%;
			background: transparent;
			border: 3px solid #e31919;
			box-shadow:
				0 0 0 1px rgba(255, 255, 255, 0.72),
				0 0 14px rgba(255, 40, 40, 0.72);
			pointer-events: none;
		}

		.fss-hub {
			position: absolute;
			left: 50%;
			top: 50%;
			width: 172px;
			height: 172px;
			transform: translate(-50%, -50%);
			border-radius: 50%;
			background: linear-gradient(165deg, rgba(18, 58, 88, 0.92) 0%, rgba(10, 38, 58, 0.96) 100%);
			border: 1px solid rgba(160, 210, 255, 0.22);
			box-shadow:
				inset 0 1px 0 rgba(255, 255, 255, 0.06),
				0 6px 20px rgba(2, 12, 24, 0.45);
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			text-align: center;
			gap: 4px;
			padding: 16px;
			z-index: 6;
		}

		.fss-hub-line1 {
			display: block;
			font-size: 0.74rem;
			font-weight: 600;
			letter-spacing: 0.11em;
			text-transform: uppercase;
			color: rgba(196, 220, 248, 0.78);
			line-height: 1.32;
		}

		.fss-hub-line2 {
			display: block;
			font-size: 1rem;
			font-weight: 700;
			letter-spacing: 0.03em;
			line-height: 1.28;
			background: linear-gradient(95deg, #a8d4ff 0%, #ffffff 45%, #c8e4ff 100%);
			-webkit-background-clip: text;
			background-clip: text;
			-webkit-text-fill-color: transparent;
			text-shadow: none;
			filter: drop-shadow(0 0 10px rgba(100, 170, 255, 0.25));
		}

		/* Pivot at circle centre; equal 360/7 spacing on orbit radius */
		.fss-step {
			position: absolute;
			left: 50%;
			top: 50%;
			width: 0;
			height: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			z-index: 4;
			transform: translate(-50%, -50%) rotate(var(--step-rot, 0deg)) translateY(calc(-1 * var(--orbit-r))) rotate(calc(-1 * var(--step-rot, 0deg)));
			opacity: 0;
		}

		/* Step 1 (Concepts & Design) at top; steps clockwise by 360°/7 */
		.fss-step[data-step="1"] { --step-rot: calc(0turn / 7); }
		.fss-step[data-step="2"] { --step-rot: calc(1turn / 7); }
		.fss-step[data-step="3"] { --step-rot: calc(2turn / 7); }
		.fss-step[data-step="4"] { --step-rot: calc(3turn / 7); }
		.fss-step[data-step="5"] { --step-rot: calc(4turn / 7); }
		.fss-step[data-step="6"] { --step-rot: calc(5turn / 7); }
		.fss-step[data-step="7"] { --step-rot: calc(6turn / 7); }
		.fss-step[data-step="8"] { display: none; }

		.fss-step-face {
			flex-shrink: 0;
			width: calc(var(--fss-step-w) - 6px);
			height: calc(var(--fss-step-h) - 4px);
			position: relative;
			overflow: hidden;
			border-radius: 12px;
			clip-path: polygon(3.5% 0, 96% 0, 100% 16%, 97% 100%, 4% 100%, 0 84%);
			background:
				linear-gradient(122deg, rgba(240, 252, 255, 0.2) 0%, rgba(240, 252, 255, 0) 42%, rgba(240, 252, 255, 0.11) 100%),
				linear-gradient(162deg, #2898d8 0%, #1e78b4 46%, #165b8c 100%);
			background-size: 220% 100%, 100% 100%;
			border: 1px solid rgba(120, 224, 255, 0.6);
			box-shadow:
				0 5px 14px rgba(8, 26, 46, 0.28),
				0 0 0 1px rgba(0, 200, 255, 0.22),
				inset 0 1px 0 rgba(255, 255, 255, 0.18);
			color: #eaf5ff;
			font-size: 0.68rem;
			line-height: 1.18;
			font-weight: 600;
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 10px 12px;
			transform: rotate(0deg);
			transition:
				transform 0.55s cubic-bezier(0.33, 1, 0.68, 1),
				border-color 0.55s cubic-bezier(0.33, 1, 0.68, 1),
				box-shadow 0.55s cubic-bezier(0.33, 1, 0.68, 1),
				filter 0.45s ease;
			animation: fss-face-glow 4.8s ease-in-out infinite;
			animation-delay: calc(var(--fss-i, 0) * 0.42s);
		}

		.fss-step-face::after {
			content: "";
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			height: 3px;
			background: linear-gradient(90deg, #ff4d4d 0%, #ff1f1f 100%);
			box-shadow: 0 0 8px rgba(255, 54, 54, 0.45);
			pointer-events: none;
		}

		.fss-step:hover .fss-step-face {
			transform: scale(1.05);
			border-color: rgba(140, 235, 255, 0.78);
			filter: brightness(1.12);
		}

		.fss-step.active .fss-step-face {
			border-color: rgba(200, 235, 255, 0.85);
			filter: brightness(1.1);
		}

		@media (prefers-reduced-motion: no-preference) {
			.fss-step-face {
				animation:
					fss-face-glow 4.8s ease-in-out infinite,
					fss-face-sheen 14s ease-in-out infinite,
					fss-float 6.6s ease-in-out infinite;
				animation-delay: calc(var(--fss-i, 0) * 0.42s), calc(var(--fss-i, 0) * 0.55s), calc(var(--fss-i, 0) * 0.35s);
			}

			.fss-step.active .fss-step-face {
				animation:
					fss-face-glow-active 3.2s ease-in-out infinite,
					fss-face-sheen 10s ease-in-out infinite,
					fss-float 4.8s ease-in-out infinite;
				animation-delay: calc(var(--fss-i, 0) * 0.32s), calc(var(--fss-i, 0) * 0.42s), calc(var(--fss-i, 0) * 0.25s);
			}
		}

		.fss-side-panel {
			border: 1px solid rgba(134, 178, 239, 0.26);
			border-radius: 14px;
			background: rgba(6, 14, 28, 0.55);
			padding: 18px;
			min-height: 420px;
			display: flex;
			flex-direction: column;
			gap: 14px;
			overflow: hidden;
		}

		.fss-panel-head {
			font-size: 1.2rem;
			font-weight: 700;
			color: #eaf5ff;
		}

		.fss-panel-sub {
			font-size: 0.92rem;
			color: #a7c0de;
			line-height: 1.6;
		}

		.fss-panel-media {
			min-height: clamp(240px, 36vw, 340px);
			height: clamp(240px, 36vw, 340px);
			border-radius: 12px;
			border: 1px solid rgba(136, 186, 244, 0.28);
			background:
				radial-gradient(200px 120px at 30% 40%, rgba(80, 143, 231, 0.3), rgba(80, 143, 231, 0)),
				linear-gradient(145deg, rgba(16, 33, 60, 0.95), rgba(10, 19, 34, 0.95));
			position: relative;
			overflow: hidden;
			flex-shrink: 0;
		}

		.fss-panel-media-gradient {
			position: absolute;
			inset: 0;
			z-index: 0;
			pointer-events: none;
			opacity: 0.5;
			transition: background 0.45s ease;
		}

		.fss-panel-slides-wrap {
			position: absolute;
			inset: 0;
			z-index: 1;
		}

		.fss-panel-slide {
			position: absolute;
			inset: 0;
			margin: 0;
			padding: 10px 12px 20px;
			box-sizing: border-box;
			display: flex;
			align-items: center;
			justify-content: center;
			opacity: 0;
			transition: opacity 0.55s ease;
			pointer-events: none;
		}

		.fss-panel-slide.is-active {
			opacity: 1;
			pointer-events: auto;
		}

		.fss-panel-slide img {
			position: relative;
			display: block;
			width: auto;
			height: auto;
			max-width: 100%;
			max-height: 100%;
			object-fit: contain;
			object-position: center;
			border-radius: 4px;
		}

		.fss-panel-slider-dots {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			bottom: 10px;
			z-index: 3;
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 8px;
			padding: 6px 12px;
			border-radius: 999px;
			background: rgba(6, 14, 28, 0.55);
			backdrop-filter: blur(6px);
		}

		.fss-panel-slider-dot {
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.35);
			border: 1px solid rgba(130, 187, 255, 0.45);
			padding: 0;
			cursor: pointer;
			transition: transform 0.2s ease, background 0.2s ease;
		}

		.fss-panel-slider-dot:hover,
		.fss-panel-slider-dot:focus-visible {
			background: rgba(185, 215, 251, 0.85);
			outline: none;
		}

		.fss-panel-slider-dot.is-active {
			background: #82bbff;
			border-color: rgba(255, 255, 255, 0.55);
			transform: scale(1.2);
		}

		.fss-panel-media::after {
			content: "Process Preview";
			position: absolute;
			right: 10px;
			top: 8px;
			bottom: auto;
			font-size: 0.68rem;
			letter-spacing: 0.08em;
			text-transform: uppercase;
			color: #b9d7fb;
			opacity: 0.85;
			z-index: 2;
			pointer-events: none;
		}

		.fss-panel-points {
			display: grid;
			gap: 8px;
		}

		.fss-panel-point {
			font-size: 0.9rem;
			color: #cdddf1;
			line-height: 1.45;
			padding-left: 14px;
			position: relative;
		}

		.fss-panel-point::before {
			content: "";
			position: absolute;
			left: 0;
			top: 0.55em;
			width: 6px;
			height: 6px;
			border-radius: 50%;
			background: #82bbff;
			box-shadow: 0 0 8px rgba(130, 187, 255, 0.6);
		}

		.fss-process-caption {
			text-align: center;
			color: #b9cbe3;
			margin-top: 16px;
			font-size: 0.97rem;
			letter-spacing: 0.01em;
		}

		.achievements-section {
			background: #000;
			padding: 30px 0px 60px;
			position: relative;
			overflow: hidden;
		}

		.achievements-section::before {	
			content: "";
			position: absolute;
			inset: 0;
			/*background:
				linear-gradient(180deg, rgba(125, 182, 246, 0.08), rgba(125, 182, 246, 0)),
				repeating-linear-gradient(90deg, rgba(150, 205, 255, 0.05) 0 1px, transparent 1px 72px);*/
			pointer-events: none;
		}

		.achieve-head {
			text-align: center;
			max-width: 840px;
			margin: 0 auto 30px;
			position: relative;
		}

		.achieve-title {
			color: #ecf6ff;
			font-size: clamp(1.55rem, 3vw, 2.35rem);
			margin-bottom: 14px;
			letter-spacing: 0.01em;
		}

		.achieve-title strong {
			background: linear-gradient(90deg, #7fc2ff 0%, #ffffff 45%, #b6dcff 100%);
			-webkit-background-clip: text;
			background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.achieve-intro {
			max-width: 820px;
			margin: 0 auto 26px;
			color: #9bb3ce;
			font-size: 0.95rem;
			line-height: 1.75;
			text-align: center;
		}

		.achieve-coverflow {
			position: relative;
			height: 430px;
			perspective: 1200px;
			overflow: hidden;
			user-select: none;
		}

		.achieve-track {
			position: relative;
			width: 100%;
			height: 100%;
		}

		.achieve-slide {
			position: absolute;
			top: 50%;
			left: 50%;
			width: min(34vw, 320px);
			aspect-ratio: 3 / 4;
			cursor: default;
			border-radius: 18px;
			overflow: hidden;
			border: 1px solid rgba(146, 198, 255, 0.34);
			box-shadow: 0 20px 42px rgba(2, 9, 18, 0.52);
			background: linear-gradient(165deg, #f4f7fb 0%, #e8eef6 100%);
			transform-style: preserve-3d;
			transition: transform 650ms cubic-bezier(0.22, 0.61, 0.36, 1), opacity 650ms ease, filter 650ms ease, box-shadow 650ms ease, border-color 650ms ease;
			pointer-events: none;
		}

		.achieve-slide-media {
			position: absolute;
			inset: 10px 10px 54px;
			border-radius: 12px;
			overflow: hidden;
			background: #fff;
			box-shadow: inset 0 0 0 1px rgba(18, 42, 72, 0.08);
		}

		.achieve-slide img {
			width: 100%;
			height: 100%;
			object-fit: contain;
			object-position: center;
			padding: 6px;
			box-sizing: border-box;
			background: #fff;
			filter: saturate(1.04) contrast(1.04);
		}

		.achieve-slide::after {
			content: "";
			position: absolute;
			inset: 0;
			background: linear-gradient(180deg, rgba(2, 8, 16, 0) 58%, rgba(2, 8, 16, 0.9) 100%);
			pointer-events: none;
		}

		.achieve-slide-title {
			position: absolute;
			left: 14px;
			right: 14px;
			bottom: 12px;
			z-index: 2;
			margin: 0;
			font-size: 0.96rem;
			line-height: 1.35;
			color: #ecf6ff;
			text-align: left;
		}

		.achieve-slide.is-active {
			border-color: rgba(180, 223, 255, 0.72);
			box-shadow: 0 32px 56px rgba(4, 14, 29, 0.74), 0 0 0 1px rgba(160, 214, 255, 0.35);
			z-index: 4;
			cursor: pointer;
			pointer-events: auto;
		}

		.achieve-nav {
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			width: 38px;
			height: 38px;
			border-radius: 50%;
			border: 1px solid rgba(150, 207, 255, 0.45);
			background: rgba(20, 46, 76, 0.58);
			color: #dff1ff;
			display: grid;
			place-items: center;
			cursor: pointer;
			z-index: 80;
		}

		.achieve-nav.prev { left: 12px; }
		.achieve-nav.next { right: 12px; }

		.achieve-lightbox {
			position: fixed;
			inset: 0;
			display: none;
			align-items: center;
			justify-content: center;
			background: rgba(2, 8, 16, 0.88);
			backdrop-filter: blur(6px);
			z-index: 9999;
			padding: 30px;
		}

		.achieve-lightbox.is-open {
			display: flex;
		}

		.achieve-lightbox-panel {
			position: relative;
			width: min(62vw, 640px);
			height: min(90vh, 820px);
			border-radius: 12px;
			border: 1px solid rgba(156, 210, 255, 0.42);
			background: #0a1627;
			box-shadow: 0 28px 60px rgba(0, 0, 0, 0.55);
			overflow: hidden;
			display: flex;
			flex-direction: column;
		}

		.achieve-lightbox-head {
			padding: 10px 14px;
			color: #dcedff;
			font-size: 0.88rem;
			letter-spacing: 0.02em;
			border-bottom: 1px solid rgba(135, 193, 255, 0.2);
			background: rgba(18, 44, 76, 0.5);
		}

		.achieve-lightbox-img {
			width: 100%;
			flex: 1 1 auto;
			min-height: 0;
			max-height: calc(92vh - 56px);
			height: auto;
			object-fit: contain;
			object-position: center;
			background: #f7f9fc;
			padding: 16px;
			box-sizing: border-box;
		}

		.achieve-lightbox-close {
			position: absolute;
			top: 10px;
			right: 10px;
			width: 34px;
			height: 34px;
			border-radius: 50%;
			border: 1px solid rgba(172, 220, 255, 0.56);
			background: rgba(10, 28, 48, 0.7);
			color: #e9f6ff;
			font-size: 1.1rem;
			line-height: 1;
			cursor: pointer;
		}

		.cta-section {
			position: relative;
			background: #000;
			color: #e9f3ff;
			padding: 56px 0 72px;
			overflow: hidden;
			text-align: center;
		}

		.cta-section::before {
			content: "";
			position: absolute;
			inset: 0;
			background:
				radial-gradient(700px 300px at 20% 20%, rgba(74, 134, 228, 0.14) 0%, rgba(74, 134, 228, 0) 65%),
				radial-gradient(650px 340px at 80% 85%, rgba(60, 112, 210, 0.1) 0%, rgba(60, 112, 210, 0) 70%);
			pointer-events: none;
		}

		.cta-section .container {
			position: relative;
			z-index: 2;
		}

		.cta-inner {
			max-width: 780px;
			margin: 0 auto;
		}

		.cta-eyebrow {
			display: inline-flex;
			align-items: center;
			gap: 10px;
			font-size: 11px;
			letter-spacing: 0.26em;
			text-transform: uppercase;
			color: #9fc7ff;
			margin-bottom: 16px;
		}

		.cta-eyebrow-dot {
			width: 7px;
			height: 7px;
			border-radius: 50%;
			background: #7eb8ff;
			box-shadow: 0 0 10px rgba(126, 184, 255, 0.9);
		}

		.cta-title {
			margin: 0 0 14px;
			font-size: clamp(1.55rem, 3vw, 2.35rem);
			line-height: 1.2;
			color: #f5f9ff;
			font-weight: 700;
		}

		.cta-title strong {
			background: linear-gradient(95deg, #85bdff 0%, #ffffff 48%, #cbe2ff 100%);
			-webkit-background-clip: text;
			background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.cta-sub {
			max-width: 620px;
			margin: 0 auto 28px;
			font-size: 1rem;
			line-height: 1.75;
			color: #b8c9df;
		}

		.cta-btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			padding: 14px 30px;
			border-radius: 999px;
			text-decoration: none;
			font-size: 0.82rem;
			letter-spacing: 0.06em;
			text-transform: capitalize;
			font-weight: 700;
			background: linear-gradient(135deg, #66afff, #3888d9);
			color: #071627;
			border: 1px solid rgba(173, 220, 255, 0.55);
			box-shadow: 0 8px 22px rgba(39, 120, 195, 0.35);
			transition: transform .25s ease, box-shadow .25s ease;
		}

		.cta-btn span {
			font-size: 1.05rem;
			line-height: 1;
		}

		.cta-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 12px 28px rgba(39, 120, 195, 0.45);
			color: #071627;
		}


		@media (max-width: 991px) {
			.fss-process-grid {
				grid-template-columns: 1fr;
				gap: 18px;
			}

			.fss-circle-wrap {
				max-width: min(100%, 360px);
			}

			.fss-hub {
				width: 132px;
				height: 132px;
				padding: 12px;
			}

			.fss-hub-line1 {
				font-size: 0.62rem;
				letter-spacing: 0.08em;
				line-height: 1.28;
			}

			.fss-hub-line2 {
				font-size: 0.82rem;
				line-height: 1.24;
			}

			.fss-loop-title {
				font-size: 0.74rem;
				top: 4%;
			}

			.fss-circle-wrap {
				--orbit-r: 36.5cqw;
				--fss-step-w: 118px;
				--fss-step-h: 56px;
			}

			.fss-step[data-step="1"] { --step-rot: calc(0turn / 7); }
			.fss-step[data-step="2"] { --step-rot: calc(1turn / 7); }
			.fss-step[data-step="3"] { --step-rot: calc(2turn / 7); }
			.fss-step[data-step="4"] { --step-rot: calc(3turn / 7); }
			.fss-step[data-step="5"] { --step-rot: calc(4turn / 7); }
			.fss-step[data-step="6"] { --step-rot: calc(5turn / 7); }
			.fss-step[data-step="7"] { --step-rot: calc(6turn / 7); }

			.fss-step-face {
				font-size: 0.56rem;
				padding: 8px 9px;
			}

			.optimise-section,
			.fss-process-section,
			.achievements-section,
			.cta-section {
				padding: 52px 0;
			}

			.achieve-coverflow {
				height: 360px;
				perspective: 900px;
			}

			.achieve-slide {
				width: min(68vw, 300px);
			}

			.fss-process-frame {
				padding: 18px 14px 16px;
			}

			.fss-side-panel {
				min-height: 0;
				padding: 14px;
			}

			.fss-panel-media {
				min-height: min(52vw, 300px);
				height: min(52vw, 300px);
			}

			.fss-panel-slide {
				padding: 28px 10px 40px;
			}

			.fss-mobile-nav {
				display: flex;
				order: 1;
			}

			.fss-circle-wrap {
				display: none;
			}

			.fss-side-panel {
				order: 2;
			}
		}

		@media (max-width: 767px) {
			.optimise-section .container,
			.fss-process-section .container,
			.achievements-section .container,
			.cta-section .container {
				padding-left: 16px;
				padding-right: 16px;
			}

			.optimise-title br {
				display: none;
			}

			.optimise-visual {
				height: min(88vw, 340px);
				margin-top: 16px;
				border-radius: 16px;
			}

			.optimise-part-label {
				font-size: 0.52rem;
				letter-spacing: 0.06em;
				bottom: -28px;
				white-space: normal;
				text-align: center;
				line-height: 1.2;
				max-width: 120%;
			}

			.optimise-result.in-frame {
				width: 92%;
				padding: 8px 10px;
				gap: 8px;
			}

			.optimise-result-item {
				min-width: 0;
				flex: 1 1 45%;
			}

			.fss-mobile-nav {
				display: flex;
				order: 1;
			}

			.fss-circle-wrap {
				display: none;
			}

			.fss-side-panel {
				order: 2;
				min-height: 0;
			}

			.fss-process-title {
				margin-bottom: 16px;
				padding: 0 4px;
			}

			.fss-loop-title {
				white-space: normal;
				text-align: center;
				left: 50%;
				right: auto;
				width: 92%;
				transform: translateX(-50%);
				line-height: 1.25;
				padding: 0 8px;
			}

			.achieve-nav {
				width: 42px;
				height: 42px;
			}

			.achieve-nav.prev {
				left: 6px;
			}

			.achieve-nav.next {
				right: 6px;
			}

			.achieve-coverflow {
				height: clamp(360px, 92vw, 420px);
			}

			.achieve-slide {
				width: min(82vw, 300px);
			}

			.achieve-slide-title {
				font-size: 0.78rem;
				line-height: 1.28;
			}

			.achieve-lightbox {
				padding: 16px;
			}

			.achieve-lightbox-panel {
				width: min(100%, 520px);
				max-height: 88vh;
				height: auto;
			}
		}

		@media (max-width: 575px) {
			.optimise-section,
			.fss-process-section,
			.achievements-section,
			.cta-section {
				padding: 32px 0;
			}

			.optimise-tags {
				gap: 8px;
			}

			.optimise-tag {
				font-size: 0.74rem;
				padding: 7px 11px;
			}

			.optimise-visual {
				height: min(96vw, 320px);
			}

			.optimise-part-wrap {
				width: min(40vw, 118px);
				height: 70px;
			}

			.optimise-part-wrap.metal {
				left: 4%;
				top: 30%;
			}

			.optimise-part-wrap.plastic {
				right: 3%;
				left: auto;
				top: 30%;
			}

			.optimise-line.l1,
			.optimise-line.l2 {
				width: 42%;
				left: 29%;
				top: 48%;
			}

			.optimise-result.in-frame {
				bottom: 10px;
			}

			.optimise-result-value {
				font-size: 0.92rem;
			}

			.fss-process-section {
				padding-top: 28px;
				padding-bottom: 28px;
			}

			.fss-process-title,
			.achieve-title {
				font-size: clamp(1.25rem, 6vw, 1.65rem);
				padding: 0 8px;
			}

			.fss-process-frame {
				padding: 12px 10px 14px;
				border-radius: 12px;
			}

			.fss-mobile-step {
				font-size: 0.68rem;
				padding: 8px 12px;
			}

			.fss-circle-wrap {
				display: none;
			}

			.fss-side-panel {
				padding: 12px;
				border-radius: 12px;
			}

			.fss-panel-media {
				min-height: min(68vw, 280px);
				height: min(68vw, 280px);
			}

			.fss-panel-slide {
				padding: 22px 8px 36px;
			}

			.fss-panel-slider-dots {
				bottom: 8px;
			}

			.fss-panel-head {
				font-size: 1.05rem;
			}

			.fss-panel-sub {
				font-size: 0.85rem;
			}

			.fss-panel-point {
				font-size: 0.82rem;
			}

			.fss-process-caption {
				font-size: 0.88rem;
				padding: 0 6px;
			}

			.achieve-head {
				margin-bottom: 20px;
			}

			.achieve-coverflow {
				height: clamp(380px, 98vw, 460px);
				perspective: 760px;
				-webkit-overflow-scrolling: touch;
			}

			.achieve-slide {
				width: min(88vw, 340px);
				aspect-ratio: 4 / 5;
				border-radius: 14px;
			}

			.achieve-slide img {
				padding: 8px 10px;
			}

			.achieve-slide-title {
				font-size: 0.8rem;
				line-height: 1.3;
			}

			.achieve-lightbox {
				padding: 10px;
			}

			.achieve-lightbox-panel {
				width: 100%;
				max-width: 100%;
				max-height: 90dvh;
				height: auto;
				min-height: 0;
			}

			.achieve-lightbox-img {
				max-height: calc(90dvh - 52px);
			}

			.cta-title {
				font-size: clamp(1.35rem, 5.5vw, 1.75rem);
			}

			.cta-sub {
				font-size: 0.94rem;
				margin-bottom: 22px;
			}

			.cta-btn {
				width: 100%;
				max-width: 300px;
			}
		}
	</style>
	@endsection('styles')

	<main class="main page-wraper">
		
		<section class="hero-palette">
			<div>
				@include('hero_section')
			</div>
		</section>

		<section class="optimise-section">
			<div class="container pt-0 pb-0">
				<div class="text-center">
					{{-- <div class="optimise-eyebrow">
						<span class="optimise-eyebrow-dot"></span>
						Design Optimisation
					</div> --}}
					<h2 class="optimise-title">
						Weight & Cost Savings Through <br><strong>Smart Design</strong>
					</h2>
					<div class="optimise-tags">
						<span class="optimise-tag active" data-product="front-end">Front End Structure</span>
						<span class="optimise-tag" data-product="battery-tray">Battery Tray</span>
						{{-- <span class="optimise-tag" data-product="tail-door">Tail Door Inner Structure</span> --}}
					</div>
					<div class="optimise-visual optimise-reveal">
						<div class="optimise-product-title" id="optimiseProductTitle">Front End Structure</div>
						<div class="optimise-part-wrap metal">
							<div class="optimise-part" id="optimiseMetalPart" style="background-image: url('{{ asset("assets/images/fes-metal.png") }}');"></div>
							<span class="optimise-part-label">Metal</span>
						</div>
						<div class="optimise-part-wrap plastic">
							<div class="optimise-part" id="optimisePlasticPart" style="background-image: url('{{ asset("assets/images/fes-plastic.png") }}');"></div>
							<span class="optimise-part-label">Engineered Glass Filled Polymer</span>
						</div>
						<div class="optimise-line l1"></div>
						<div class="optimise-line l2"></div>
						<div class="optimise-result in-frame">
							<div class="optimise-result-item">
								<div class="optimise-result-title">Weight Reduction</div>
								<div class="optimise-result-value" id="optimiseWeightValue">45%</div>
							</div>
							<div class="optimise-result-item">
								<div class="optimise-result-title">Cost Saving</div>
								<div class="optimise-result-value" id="optimiseCostValue">10-15%</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="fss-process-section">
			<div class="container pt-0 pb-0">
				<h3 class="fss-process-title">Full Service <strong> Supplier</strong></h3>
				<div class="fss-process-frame">
					<div class="fss-process-grid">
						<div class="fss-mobile-nav" id="fssMobileNav" aria-label="Process steps">
							<button type="button" class="fss-mobile-step active" data-step="1">Concepts &amp; Design</button>
							<button type="button" class="fss-mobile-step" data-step="2">Engineering</button>
							<button type="button" class="fss-mobile-step" data-step="3">Material Selection</button>
							<button type="button" class="fss-mobile-step" data-step="4">Simulation &amp; Testing</button>
							<button type="button" class="fss-mobile-step" data-step="5">Proto Build &amp; Validation</button>
							<button type="button" class="fss-mobile-step" data-step="6">Tooling Development</button>
							<button type="button" class="fss-mobile-step" data-step="7">Manufacturing &amp; Supply Chain</button>
						</div>
						<div class="fss-circle-wrap">
							<div class="fss-orbit"></div>
							<span class="fss-orbit-dot" aria-hidden="true"><span class="fss-orbit-dot-spin"><span class="fss-orbit-dot-arm"><span class="fss-orbit-dot-shape"></span></span></span></span>
							<div class="fss-hub">
								<span class="fss-hub-line1">Product Development</span>
								<span class="fss-hub-line2">Capability</span>
							</div>
							<div class="fss-step" data-step="1" style="--fss-i: 0"><span class="fss-step-face">Concepts &amp; Design</span></div>
							<div class="fss-step" data-step="2" style="--fss-i: 1"><span class="fss-step-face">Engineering</span></div>
							<div class="fss-step" data-step="3" style="--fss-i: 2"><span class="fss-step-face">Material Selection</span></div>
							<div class="fss-step" data-step="4" style="--fss-i: 3"><span class="fss-step-face">Simulation &amp; Testing</span></div>
							<div class="fss-step" data-step="5" style="--fss-i: 4"><span class="fss-step-face">Proto Build &amp; Validation</span></div>
							<div class="fss-step" data-step="6" style="--fss-i: 5"><span class="fss-step-face">Tooling Development</span></div>
							<div class="fss-step" data-step="7" style="--fss-i: 6"><span class="fss-step-face">Manufacturing &amp; Supply Chain</span></div>
						</div>
						<div class="fss-side-panel">
							<div class="fss-panel-head" id="fssPanelTitle">Concepts &amp; Design</div>
							<div class="fss-panel-sub" id="fssPanelSub">
								Translate packaging constraints into optimized concepts ready for engineering evaluation.
							</div>
							<div class="fss-panel-media" id="fssPanelMedia">
								<div class="fss-panel-media-gradient" id="fssPanelMediaGradient" aria-hidden="true" style="background: radial-gradient(220px 120px at 30% 40%, rgba(89, 166, 255, 0.34), rgba(89, 166, 255, 0)), linear-gradient(145deg, rgba(11, 39, 78, 0.95), rgba(8, 24, 53, 0.95))"></div>
								<div class="fss-panel-slides-wrap">
									<div class="fss-panel-slides" id="fssPanelSlides" role="region" aria-roledescription="carousel" aria-label="Process step preview"></div>
								</div>
								<div class="fss-panel-slider-dots" id="fssPanelSliderDots" role="group" aria-label="Preview slides" hidden></div>
							</div>
							<div class="fss-panel-points" id="fssPanelPoints">
								<div class="fss-panel-point">Feasibility-driven concept alternatives</div>
								<div class="fss-panel-point">CAD architecture with DFM direction</div>
								<div class="fss-panel-point">Part consolidation opportunities</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="achievements-section" id="awards-certifications-ipr" aria-labelledby="achieve-section-title">
			<div class="container pt-0 pb-0">
				<div class="achieve-head">
					<h2 class="achieve-title" id="achieve-section-title">Awards, Certifications &amp; <strong>IPR's</strong></h2>
				</div>

				<div class="achieve-coverflow" id="achieveCoverflow" role="region" aria-label="Awards and certifications gallery">
					<button class="achieve-nav prev" type="button" aria-label="Previous award or certification">&#10094;</button>
					<div class="achieve-track">
						@foreach ($achievements as $achievement)
						<article class="achieve-slide" itemscope itemtype="https://schema.org/{{ $achievement['type'] === 'certification' ? 'EducationalOccupationalCredential' : ($achievement['type'] === 'award' ? 'Award' : ($achievement['type'] === 'patent' ? 'Patent' : 'CreativeWork')) }}">
							<div class="achieve-slide-media">
								<img src="{{ asset($achievement['image']) }}" alt="{{ $achievement['alt'] }}" title="{{ $achievement['title'] }}" loading="lazy" decoding="async" itemprop="image">
							</div>
							<h3 class="achieve-slide-title" itemprop="name">{{ $achievement['title'] }}</h3>
							<meta itemprop="description" content="{{ $achievement['description'] }}">
							@if (!empty($achievement['identifier']))
							<meta itemprop="identifier" content="{{ $achievement['identifier'] }}">
							@endif
						</article>
						@endforeach
					</div>
					<button class="achieve-nav next" type="button" aria-label="Next award or certification">&#10095;</button>
				</div>
			</div>
		</section>

		<section class="cta-section" aria-label="Call to action">
			<div class="container pt-0 pb-0">
				<div class="cta-inner" id="ctaPanel">
					<div class="cta-eyebrow">
						<span class="cta-eyebrow-dot"></span>
						Partner With Autodynamics
					</div>
					<h3 class="cta-title">Engineering Precision. <strong>Lightweighting Mobility.</strong> Enabling Performance.</h3>
					<p class="cta-sub">From metal-to-plastic conversion to high strength-glass-filled components - upload your design and our engineering team will take it forward.</p>
					<a class="cta-btn" href="{{ route('upload-design') }}#upload-form">Upload Your Design <span aria-hidden="true"></span></a>
				</div>
			</div>
		</section>
		<div class="achieve-lightbox" id="achieveLightbox" aria-hidden="true">
			<div class="achieve-lightbox-panel">
				<button class="achieve-lightbox-close" type="button" aria-label="Close preview">&times;</button>
				<div class="achieve-lightbox-head" id="achieveLightboxTitle"></div>
				<img class="achieve-lightbox-img" id="achieveLightboxImg" src="" alt="Award preview">
			</div>
		</div>

	</main>

	@section('scripts')
		<script>
			gsap.registerPlugin(ScrollTrigger);
			document.querySelectorAll(".count-text").forEach(function (counter) {
				let target = counter.getAttribute("data-stop");
				gsap.fromTo(counter, {
					innerText: 0
				}, {
					innerText: target,
					duration: 2,
					ease: "power1.out",
					snap: {
						innerText: 1
					},

					scrollTrigger: {
						trigger: counter,
						start: "top 85%"
					},

					onUpdate: function () {
						counter.innerText = Math.ceil(counter.innerText);
					}
				});
			});
		</script>

		<script>
			gsap.registerPlugin(ScrollTrigger);
			document.querySelectorAll(".counter").forEach(counter => {
				let target = +counter.getAttribute("data-target");
				gsap.fromTo(counter, {
					innerText: 0
				}, {
					innerText: target,	
					duration: 2,
					ease: "power1.out",
					snap: {
						innerText: 1
					},
					scrollTrigger: {
						trigger: counter,
						start: "top 80%"
					},
					onUpdate: function() {
						counter.innerText = Math.ceil(counter.innerText);
					}
				});
			});
		</script>

		<script>
			(function () {
				var video = document.getElementById("companyVideo");
				if (!video) return;
				video.muted = true;
				var playAttempt = video.play();
				if (playAttempt && typeof playAttempt.catch === "function") {
					playAttempt.catch(function () {});
				}
			})();
		</script>

		<script>
			const cards = document.querySelectorAll('.case-card');
			cards.forEach(card => {
				card.addEventListener('mouseenter', () => {
					if (window.innerWidth > 991) {
						cards.forEach(c => c.classList.remove('active'));
						card.classList.add('active');
					}
				})
			})
		</script>

		<script>
			(function () {
				const optimiseSection = document.querySelector('.optimise-section');
				if (!optimiseSection) return;
				const hasGsap = typeof gsap !== 'undefined';
				const hasScrollTrigger = typeof ScrollTrigger !== 'undefined';
				const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
				const optimiseTags = optimiseSection.querySelectorAll('.optimise-tag');
				const titleEl = optimiseSection.querySelector('#optimiseProductTitle');
				const metalEl = optimiseSection.querySelector('#optimiseMetalPart');
				const plasticEl = optimiseSection.querySelector('#optimisePlasticPart');
				const weightEl = optimiseSection.querySelector('#optimiseWeightValue');
				const costEl = optimiseSection.querySelector('#optimiseCostValue');
				let activeKey = 'front-end';
				let autoTimer = null;
				let autoEnabled = false;
				const productOrder = ['front-end', 'battery-tray'];
				const productData = {
					'front-end': {
						title: 'Front End Structure',
						metalImg: '{{ asset("assets/images/fes-metal.png") }}',
						plasticImg: '{{ asset("assets/images/fes-plastic.png") }}',
						weight: '45%',
						cost: '10-15%'
					},
					'battery-tray': {
						title: 'Battery Tray',
						metalImg: '{{ asset("assets/images/metal_battery-trayyy.png") }}',
						plasticImg: '{{ asset("assets/images/battery-tray-plastic.png") }}',
						weight: '42%',
						cost: '30%'
					}
				};

				function setTagActive(key) {
					optimiseTags.forEach((tag) => tag.classList.toggle('active', tag.dataset.product === key));
				}

				function animateMetrics() {
					if (!hasGsap) return;
					gsap.fromTo(
						optimiseSection.querySelectorAll('.optimise-result-item'),
						{ opacity: 0, y: 12 },
						{ opacity: 1, y: 0, duration: reduceMotion ? 0.2 : 0.45, stagger: 0.14, ease: 'power2.out' }
					);
				}

				function clearAuto() {
					if (autoTimer) {
						clearInterval(autoTimer);
						autoTimer = null;
					}
				}

				function applyProduct(key, animate) {
					const item = productData[key];
					if (!item || !titleEl || !metalEl || !plasticEl || !weightEl || !costEl) return;
					activeKey = key;
					setTagActive(key);

					if (!animate || reduceMotion) {
						titleEl.textContent = item.title;
						metalEl.style.backgroundImage = 'url("' + item.metalImg + '")';
						plasticEl.style.backgroundImage = 'url("' + item.plasticImg + '")';
						weightEl.textContent = item.weight;
						costEl.textContent = item.cost;
						return;
					}

					if (!hasGsap) {
						titleEl.textContent = item.title;
						metalEl.style.backgroundImage = 'url("' + item.metalImg + '")';
						plasticEl.style.backgroundImage = 'url("' + item.plasticImg + '")';
						weightEl.textContent = item.weight;
						costEl.textContent = item.cost;
						return;
					}

					gsap.timeline()
						.to([titleEl, metalEl, plasticEl, weightEl, costEl], { opacity: 0, y: 10, duration: 0.2, stagger: 0.03, ease: 'power1.in' })
						.call(function () {
							titleEl.textContent = item.title;
							metalEl.style.backgroundImage = 'url("' + item.metalImg + '")';
							plasticEl.style.backgroundImage = 'url("' + item.plasticImg + '")';
							weightEl.textContent = item.weight;
							costEl.textContent = item.cost;
						})
						.to([titleEl, metalEl, plasticEl, weightEl, costEl], { opacity: 1, y: 0, duration: 0.28, stagger: 0.04, ease: 'power2.out' })
						.call(animateMetrics);
				}

				if (hasGsap && hasScrollTrigger) {
					const tl = gsap.timeline({
						scrollTrigger: {
							trigger: optimiseSection,
							start: "top 78%",
							once: true
						}
					});

					tl.fromTo(
						'.optimise-section .optimise-eyebrow, .optimise-section .optimise-title, .optimise-section .optimise-tags',
						{ y: 28, opacity: 0 },
						{ y: 0, opacity: 1, duration: 0.8, ease: "power2.out", stagger: 0.08 }
					).fromTo(
						'.optimise-section .optimise-reveal',
						{ y: 28, opacity: 0 },
						{ y: 0, opacity: 1, duration: 0.8, ease: "power2.out" },
						"-=0.2"
					).fromTo(
						'.optimise-section .optimise-line.l2',
						{ width: 0 },
						{ width: "37%", duration: 0.85, ease: "power2.out" },
						"-=0.3"
					).fromTo(
						'.optimise-section .optimise-result-item',
						{ y: 14, opacity: 0 },
						{ y: 0, opacity: 1, duration: 0.5, ease: "power2.out", stagger: 0.14 },
						"-=0.25"
					);

					ScrollTrigger.create({
						trigger: optimiseSection,
						start: "top 78%",
						once: true,
						onEnter: function () {
							if (reduceMotion) return;
							autoEnabled = true;
							clearAuto();
							autoTimer = setInterval(function () {
								if (!autoEnabled) return;
								const currIndex = productOrder.indexOf(activeKey);
								const nextKey = productOrder[(currIndex + 1) % productOrder.length];
								applyProduct(nextKey, true);
							}, 2600);
						}
					});
				} else if (!reduceMotion) {
					autoEnabled = true;
					clearAuto();
					autoTimer = setInterval(function () {
						if (!autoEnabled) return;
						const currIndex = productOrder.indexOf(activeKey);
						const nextKey = productOrder[(currIndex + 1) % productOrder.length];
						applyProduct(nextKey, true);
					}, 2600);
				}

				optimiseTags.forEach((tag) => {
					tag.addEventListener('mouseenter', function () {
						autoEnabled = false;
						clearAuto();
						applyProduct(tag.dataset.product, true);
					});
					tag.addEventListener('click', function () {
						autoEnabled = false;
						clearAuto();
						applyProduct(tag.dataset.product, true);
					});
				});

				optimiseSection.addEventListener('mouseleave', function () {
					if (reduceMotion) return;
					if (autoEnabled) return;
					autoEnabled = true;
					clearAuto();
					autoTimer = setInterval(function () {
						const currIndex = productOrder.indexOf(activeKey);
						const nextKey = productOrder[(currIndex + 1) % productOrder.length];
						applyProduct(nextKey, true);
					}, 2600);
				});

				applyProduct(activeKey, false);
			})();
		</script>

		<script>
			(function () {
				const processSection = document.querySelector('.fss-process-section');
				if (!processSection || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

				const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
				const easeOut = reduceMotion ? 'power1.out' : 'power3.out';
				const easeInOut = reduceMotion ? 'power1.inOut' : 'power2.inOut';
				const stepStagger = reduceMotion ? 0.06 : 0.11;
				const stepInDur = reduceMotion ? 0.45 : 0.78;
				const panelFade = reduceMotion ? 0.22 : 0.42;
				const panelStagger = reduceMotion ? 0.03 : 0.065;
				const autoMs = reduceMotion ? 0 : 4500;
				const manualDotSec = reduceMotion ? 0 : 0.82;
				const hubIn = reduceMotion ? 0.4 : 0.85;

				const stepData = {
					1: {
						title: "Concepts & Design",
						sub: "Translate packaging constraints into optimized concepts ready for engineering evaluation.",
						points: [
							"Feasibility-driven concept alternatives",
							"CAD architecture with DFM direction",
							"Part consolidation opportunities"
						],
						media: "radial-gradient(220px 120px at 30% 40%, rgba(89, 166, 255, 0.34), rgba(89, 166, 255, 0)), linear-gradient(145deg, rgba(11, 39, 78, 0.95), rgba(8, 24, 53, 0.95))",
						slides: [
							{ src: '{{ asset("assets/images/fss/full-service-preview-1.png") }}', alt: 'Multiple sheet metal parts consolidated into a single molded assembly' },
							{ src: '{{ asset("assets/images/fss/full-service-preview-2.png") }}', alt: 'Concept and design development with CAE simulation and dimensional validation' }
						]
					},
					2: {
						title: "Engineering",
						sub: "Detailed engineering for performance, manufacturability, and robust integration.",
						points: [
							"Geometry tuning for stiffness-to-weight",
							"Tolerance strategy and assembly fit",
							"NPD and APQP process"
						],
						media: "radial-gradient(220px 120px at 30% 40%, rgba(61, 190, 183, 0.34), rgba(61, 190, 183, 0)), linear-gradient(145deg, rgba(10, 49, 56, 0.95), rgba(8, 30, 35, 0.95))",
						slides: [
							{ src: '{{ asset("assets/images/fss/engineering-geometry-stiffness-weight.png") }}', alt: 'Geometry tuning for stiffness-to-weight — original vs tuned FEA and stiffness improvement' },
							{ src: '{{ asset("assets/images/fss/engineering-tolerance-assembly-fit.png") }}', alt: 'Tolerance strategy and assembly fit — datum reference frame and tolerance zones' },
							{ src: '{{ asset("assets/images/fss/engineering-npd-apqp-process.png") }}', alt: 'NPD and APQP process — plan, design, develop, validate, produce, launch workflow' }
						]
					},
					3: {
						title: "Material Development / Selection",
						sub: "Select materials based on load case, environment, durability, and cost targets.",
						points: [
							"Metal-to-plastic conversion candidates",
							"Hybrid strategy with insert integration",
							"Material cost/performance balancing"
						],
						media: "radial-gradient(220px 120px at 30% 40%, rgba(103, 170, 255, 0.34), rgba(103, 170, 255, 0)), linear-gradient(145deg, rgba(12, 45, 82, 0.95), rgba(8, 26, 50, 0.95))",
						slides: [
							{ src: '{{ asset("assets/images/fss/material-selection-ansys-mechanical.png") }}', alt: 'Material selection using Ansys Mechanical — simulation, material comparison, and selected grade' },
							{ src: '{{ asset("assets/images/fss/material-selection-metal-inserts.png") }}', alt: 'Metal inserts for strength and function — threaded inserts and brackets in the molded part' }
						]
					},
					4: {
						title: "Simulation & Testing",
						sub: "Virtual and physical validation loop to reduce failures before production.",
						points: [
							"CAE checks for load and durability",
							"Failure mode validation iterations",
							"Design updates based on evidence"
						],
						media: "radial-gradient(220px 120px at 30% 40%, rgba(255, 161, 90, 0.3), rgba(255, 161, 90, 0)), linear-gradient(145deg, rgba(63, 36, 19, 0.95), rgba(39, 22, 11, 0.95))",
						slides: [
							{ src: '{{ asset("assets/images/fss/simulation-load-cases-optimization.png") }}', alt: 'Load cases and optimization strategies — CAE scenarios and design refinement' },
							{ src: '{{ asset("assets/images/fss/simulation-cae-problematic-area.png") }}', alt: 'CAE analysis — problematic area identification with stress, deformation, modal and thermal results' },
							{ src: '{{ asset("assets/images/fss/simulation-design-rectification-cae.png") }}', alt: 'Design rectifications based on CAE failure analysis — before and after stress distribution' }
						]
					},
					5: {
						title: "Proto Builds & Validation Cycles",
						sub: "Build prototypes early and validate assembly, function, and process assumptions.",
						points: [
							"Prototype build readiness checks",
							"Fit, form, function validation",
							"Corrective loops for production confidence"
						],
						media: "radial-gradient(220px 120px at 30% 40%, rgba(153, 201, 255, 0.34), rgba(153, 201, 255, 0)), linear-gradient(145deg, rgba(20, 44, 68, 0.95), rgba(12, 28, 42, 0.95))",
						slides: [
							{ src: '{{ asset("assets/images/fss/proto-validation-production-ready.png") }}', alt: 'Physical validation and testing through design rectification to production-ready part' },
							{ src: '{{ asset("assets/images/fss/proto-fixture-cad-physical-validation.png") }}', alt: 'Production part control — checking fixture and assembly fixture, CAD vs physical' },
							{ src: '{{ asset("assets/images/fss/proto-assembly-validation.png") }}', alt: 'Prototype assembly validation — technician fitting structural component' }
						]
					},
					6: {
						title: "Tooling Development",
						sub: "Tool design and build optimized for cycle time, consistency, and long-term repeatability.",
						points: [
							"Tool architecture and cooling strategy",
							"Process window definition",
							"Quality-focused tool qualification"
						],
						media: "radial-gradient(220px 120px at 30% 40%, rgba(120, 143, 165, 0.34), rgba(120, 143, 165, 0)), linear-gradient(145deg, rgba(30, 39, 49, 0.95), rgba(18, 24, 31, 0.95))",
						slides: [
							{ src: '{{ asset("assets/images/fss/tooling-mold-overview-features.png") }}', alt: 'Mold tool overview — core and cavity, cooling, ejection, and key tooling features' },
							{ src: '{{ asset("assets/images/fss/tooling-development-timeline-dashboard.png") }}', alt: 'Tooling development timeline, progress, and key activities from design through trials and approval' }
						]
					},
					7: {
						title: "Manufacturing & Supply Chain",
						sub: "Controlled mass production with quality assurance and stable delivery performance.",
						points: [
							"Production control and traceability",
							"Supplier and line coordination",
							"On-time delivery with quality gates"
						],
						media: "radial-gradient(220px 120px at 30% 40%, rgba(95, 146, 228, 0.34), rgba(95, 146, 228, 0)), linear-gradient(145deg, rgba(16, 38, 64, 0.95), rgba(10, 24, 42, 0.95))",
						slides: [
							{ src: '{{ asset("assets/images/fss/manufacturing-supply-chain-process.png") }}', alt: 'Manufacturing and supply chain — from insert loading and injection molding through WIP, assembly, Poka-Yoke, inspection, FG storage, and dispatch' }
						]
					},
				};

				const steps = processSection.querySelectorAll('.fss-step');
				const stepFaces = processSection.querySelectorAll('.fss-step-face');
				const mobileSteps = processSection.querySelectorAll('.fss-mobile-step');
				const panelTitle = processSection.querySelector('#fssPanelTitle');
				const panelSub = processSection.querySelector('#fssPanelSub');
				const panelPoints = processSection.querySelector('#fssPanelPoints');
				const panelMedia = processSection.querySelector('#fssPanelMedia');
				const panelMediaGradient = processSection.querySelector('#fssPanelMediaGradient');
				const panelEls = [panelTitle, panelSub, panelMedia, panelPoints].filter(Boolean);
				const orbitEl = processSection.querySelector('.fss-orbit');
				const orbitDotEl = processSection.querySelector('.fss-orbit-dot');
				const orbitDotSpin = orbitDotEl && orbitDotEl.querySelector('.fss-orbit-dot-spin');
				const hubEl = processSection.querySelector('.fss-hub');
				const fssTitle = processSection.querySelector('.fss-process-title');
				const fssFrame = processSection.querySelector('.fss-process-frame');
				const sidePanel = processSection.querySelector('.fss-side-panel');

				if (!fssTitle || !fssFrame || !panelTitle || !steps.length) return;

				let activeStepId = '1';
				let pauseAutoUntil = 0;
				let autoTimer = null;
				let dotAngleDeg = 0;
				const stepTurnDeg = 360 / 7;

				function stepToDeg(stepId) {
					return (parseInt(stepId, 10) - 1) * stepTurnDeg;
				}

				function nextDotAngleClockwise(accum, targetStepDeg) {
					const fromMod = ((accum % 360) + 360) % 360;
					const t = ((targetStepDeg % 360) + 360) % 360;
					const d = (t - fromMod + 360) % 360;
					return d === 0 ? accum : accum + d;
				}

				function moveOrbitDot(toStepId, fromStepId, instant, durationSec) {
					if (!orbitDotSpin || fromStepId === toStepId) return;
					if (
						!instant &&
						!reduceMotion &&
						typeof gsap !== 'undefined' &&
						typeof gsap.isTweening === 'function' &&
						gsap.isTweening(orbitDotSpin)
					) {
						const live = Number(gsap.getProperty(orbitDotSpin, 'rotation'));
						if (!isNaN(live)) dotAngleDeg = live;
					}
					const tgt = stepToDeg(toStepId);
					gsap.killTweensOf(orbitDotSpin);

					if (instant || reduceMotion) {
						dotAngleDeg = nextDotAngleClockwise(dotAngleDeg, tgt);
						gsap.set(orbitDotSpin, { rotation: dotAngleDeg });
						return;
					}

					dotAngleDeg = nextDotAngleClockwise(dotAngleDeg, tgt);
					const dur =
						durationSec != null ? durationSec : 0.58;
					gsap.to(orbitDotSpin, {
						rotation: dotAngleDeg,
						duration: dur,
						ease: easeInOut,
						overwrite: true
					});
				}

				function runPanelTransition(data) {
					gsap.killTweensOf(panelEls);
					gsap.to(panelEls, {
						opacity: 0,
						y: 12,
						duration: panelFade,
						stagger: panelStagger,
						ease: 'power2.in',
						overwrite: 'auto',
						onComplete: function () {
							applyPanelContent(data);
							gsap.fromTo(
								panelEls,
								{ opacity: 0, y: 16 },
								{
									opacity: 1,
									y: 0,
									duration: reduceMotion ? 0.3 : 0.55,
									stagger: panelStagger,
									ease: easeOut,
									overwrite: 'auto'
								}
							);
						}
					});
				}

				function clearAutoTimer() {
					if (autoTimer) {
						clearTimeout(autoTimer);
						autoTimer = null;
					}
				}

				function computeAutoCadence() {
					const period = autoMs;
					const ps = period / 1000;
					let travelSec = Math.min(ps * 0.88, ps - 0.34);
					travelSec = Math.max(2.2, travelSec);
					const travelMs = travelSec * 1000;
					const reserve = reduceMotion ? 200 : Math.round(panelFade * 1000 + 700);
					const dwellMs = Math.max(280, period - travelMs - reserve);
					return { travelSec: travelSec, dwellMs: dwellMs };
				}

				function scheduleAutoGap() {
					clearAutoTimer();
					if (autoMs <= 0) return;
					autoTimer = setTimeout(tickAutoGap, computeAutoCadence().dwellMs);
				}

				function tickAutoGap() {
					autoTimer = null;
					if (Date.now() < pauseAutoUntil) {
						const wait = Math.min(9000, Math.max(150, pauseAutoUntil - Date.now() + 100));
						autoTimer = setTimeout(tickAutoGap, wait);
						return;
					}
					const curr = parseInt(activeStepId, 10);
					const nextId = String(curr >= 7 ? 1 : curr + 1);
					beginAutoAdvanceTo(nextId);
				}

				function beginAutoAdvanceTo(nextId) {
					if (!orbitDotSpin || reduceMotion || autoMs <= 0) {
						activateStep(nextId, { skipDot: true });
						scheduleAutoGap();
						return;
					}
					const { travelSec } = computeAutoCadence();
					gsap.killTweensOf(orbitDotSpin);
					const live = Number(gsap.getProperty(orbitDotSpin, 'rotation'));
					if (!isNaN(live)) dotAngleDeg = live;
					dotAngleDeg = nextDotAngleClockwise(dotAngleDeg, stepToDeg(nextId));
					gsap.to(orbitDotSpin, {
						rotation: dotAngleDeg,
						duration: travelSec,
						ease: 'power1.inOut',
						overwrite: true,
						onComplete: function () {
							activateStep(nextId, { skipDot: true });
							scheduleAutoGap();
						}
					});
				}

				function syncStepOpacity(stepId) {
					steps.forEach((el) => {
						const on = el.dataset.step === stepId;
						gsap.to(el, {
							opacity: on ? 1 : 0.78,
							duration: reduceMotion ? 0.25 : 0.58,
							ease: 'sine.inOut',
							overwrite: 'auto'
						});
					});
				}

				function pulseHub() {
					if (!hubEl || reduceMotion) return;
					gsap.fromTo(
						hubEl,
						{ filter: 'brightness(1)' },
						{
							filter: 'brightness(1.18)',
							duration: 0.38,
							yoyo: true,
							repeat: 1,
							ease: 'sine.inOut'
						}
					);
				}

				let fssPreviewIdx = 0;
				let fssPreviewTimer = null;
				const fssPreviewSlideMs = reduceMotion ? 0 : 3000;

				function stopFssPreviewAuto() {
					if (fssPreviewTimer) {
						clearInterval(fssPreviewTimer);
						fssPreviewTimer = null;
					}
				}

				function syncFssPreviewUI() {
					const slideEls = processSection.querySelectorAll('#fssPanelSlides .fss-panel-slide');
					const dotEls = processSection.querySelectorAll('#fssPanelSliderDots .fss-panel-slider-dot');
					slideEls.forEach(function (s, j) {
						s.classList.toggle('is-active', j === fssPreviewIdx);
					});
					dotEls.forEach(function (d, j) {
						d.classList.toggle('is-active', j === fssPreviewIdx);
						d.setAttribute('aria-current', j === fssPreviewIdx ? 'true' : 'false');
					});
				}

				function startFssPreviewAuto() {
					stopFssPreviewAuto();
					const slideEls = processSection.querySelectorAll('#fssPanelSlides .fss-panel-slide');
					if (slideEls.length < 2 || fssPreviewSlideMs <= 0) return;
					fssPreviewTimer = setInterval(function () {
						fssPreviewIdx = (fssPreviewIdx + 1) % slideEls.length;
						syncFssPreviewUI();
					}, fssPreviewSlideMs);
				}

				function renderFssPreviewSlides(slides) {
					stopFssPreviewAuto();
					fssPreviewIdx = 0;
					const slidesEl = processSection.querySelector('#fssPanelSlides');
					const dotsEl = processSection.querySelector('#fssPanelSliderDots');
					if (!slidesEl || !dotsEl || !panelMedia) return;

					const list = Array.isArray(slides) ? slides : [];
					slidesEl.innerHTML = '';
					list.forEach(function (item) {
						if (!item || !item.src) return;
						const wrap = document.createElement('div');
						wrap.className = 'fss-panel-slide';
						const img = document.createElement('img');
						img.src = item.src;
						img.alt = item.alt || '';
						img.setAttribute('loading', 'lazy');
						img.setAttribute('decoding', 'async');
						wrap.appendChild(img);
						slidesEl.appendChild(wrap);
					});
					const slideNodes = slidesEl.querySelectorAll('.fss-panel-slide');
					slideNodes.forEach(function (el, i) {
						el.classList.toggle('is-active', i === 0);
					});

					dotsEl.innerHTML = '';
					const built = slidesEl.querySelectorAll('.fss-panel-slide').length;
					if (built < 2) {
						dotsEl.hidden = true;
						dotsEl.setAttribute('aria-hidden', 'true');
					} else {
						dotsEl.hidden = false;
						dotsEl.removeAttribute('aria-hidden');
						for (let j = 0; j < built; j++) {
							const btn = document.createElement('button');
							btn.type = 'button';
							btn.className = 'fss-panel-slider-dot' + (j === 0 ? ' is-active' : '');
							btn.setAttribute('aria-current', j === 0 ? 'true' : 'false');
							btn.setAttribute('aria-label', 'Preview image ' + (j + 1) + ' of ' + built);
							btn.addEventListener('click', function () {
								fssPreviewIdx = j;
								syncFssPreviewUI();
								stopFssPreviewAuto();
								startFssPreviewAuto();
							});
							dotsEl.appendChild(btn);
						}
					}
					syncFssPreviewUI();
					startFssPreviewAuto();
				}

				if (panelMedia && !panelMedia._fssPreviewHoverInit) {
					panelMedia._fssPreviewHoverInit = true;
					panelMedia.addEventListener('mouseenter', stopFssPreviewAuto);
					panelMedia.addEventListener('mouseleave', startFssPreviewAuto);
					panelMedia.addEventListener('focusin', stopFssPreviewAuto);
					panelMedia.addEventListener('focusout', function (e) {
						if (!panelMedia.contains(e.relatedTarget)) startFssPreviewAuto();
					});
					document.addEventListener('visibilitychange', function () {
						if (document.hidden) stopFssPreviewAuto();
						else startFssPreviewAuto();
					});
				}

				function applyPanelContent(data) {
					panelTitle.textContent = data.title;
					panelSub.textContent = data.sub;
					if (panelMediaGradient) {
						panelMediaGradient.style.background = data.media;
					} else if (panelMedia) {
						panelMedia.style.background = data.media;
					}
					panelPoints.innerHTML = data.points.map((point) => `<div class="fss-panel-point">${point}</div>`).join('');
					renderFssPreviewSlides(data.slides);
				}

				function syncMobileNav(stepId) {
					mobileSteps.forEach((btn) => {
						const on = btn.dataset.step === stepId;
						btn.classList.toggle('active', on);
						if (on && window.innerWidth <= 991) {
							btn.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
						}
					});
				}

				function activateStep(stepId, opts) {
					opts = opts || {};
					const instant = opts.instant;
					const skipDot = opts.skipDot;
					const data = stepData[stepId];
					if (!data) return;

					const fromStepId = activeStepId;
					activeStepId = stepId;
					steps.forEach((el) => el.classList.toggle('active', el.dataset.step === stepId));
					syncMobileNav(stepId);

					if (instant) {
						moveOrbitDot(stepId, fromStepId, true);
						applyPanelContent(data);
						return;
					}

					if (skipDot) {
						syncStepOpacity(stepId);
						runPanelTransition(data);
						pulseHub();
						return;
					}

					clearAutoTimer();
					moveOrbitDot(stepId, fromStepId, false, manualDotSec);
					syncStepOpacity(stepId);
					runPanelTransition(data);
					pulseHub();
					scheduleAutoGap();
				}

				function pauseAuto() {
					pauseAutoUntil = Date.now() + 9000;
				}

				steps.forEach((step) => {
					step.addEventListener('mouseenter', function () {
						pauseAuto();
						activateStep(step.dataset.step);
					});
					step.addEventListener('click', function () {
						pauseAuto();
						activateStep(step.dataset.step);
					});
				});

				mobileSteps.forEach((btn) => {
					btn.addEventListener('click', function () {
						pauseAuto();
						activateStep(btn.dataset.step);
					});
				});

				processSection.addEventListener('pointerdown', function (e) {
					if (e.target.closest('.fss-side-panel')) pauseAuto();
				});

				gsap.set(fssTitle, { opacity: 0, y: 28 });
				gsap.set(fssFrame, { opacity: 0, y: 32 });
				if (orbitEl) gsap.set(orbitEl, { opacity: 0, scale: 0.94 });
				if (orbitDotEl && orbitDotSpin) {
					dotAngleDeg = 0;
					gsap.set(orbitDotSpin, { rotation: 0 });
					gsap.set(orbitDotEl, { opacity: 0 });
				}
				if (hubEl) gsap.set(hubEl, { opacity: 0, scale: 0.97 });
				gsap.set(steps, { opacity: 0 });
				if (stepFaces.length) gsap.set(stepFaces, { scale: 0.82 });
				if (sidePanel) gsap.set(sidePanel, { opacity: 0, x: 36 });
				gsap.set(panelEls, { opacity: 0, y: 14 });

				activateStep('1', { instant: true });

				const processTl = gsap.timeline({
					scrollTrigger: {
						trigger: processSection,
						start: 'top 76%',
						once: true
					},
					onComplete: function () {
						syncStepOpacity(activeStepId);
						if (autoMs > 0) {
							scheduleAutoGap();
						}
						if (orbitEl && !reduceMotion) {
							gsap.to(orbitEl, {
								rotation: 360,
								duration: 100,
								repeat: -1,
								ease: 'none'
							});
						}
					}
				});

				processTl.to(fssTitle, {
					opacity: 1,
					y: 0,
					duration: reduceMotion ? 0.4 : 0.9,
					ease: easeOut
				});
				processTl.to(
					fssFrame,
					{ opacity: 1, y: 0, duration: reduceMotion ? 0.45 : 0.85, ease: easeOut },
					reduceMotion ? 0 : '-=0.35'
				);
				if (orbitEl) {
					processTl.to(
						orbitEl,
						{ opacity: 1, scale: 1, duration: reduceMotion ? 0.35 : 0.75, ease: easeInOut },
						reduceMotion ? 0 : '-=0.5'
					);
				}
				if (orbitDotEl) {
					processTl.to(
						orbitDotEl,
						{ opacity: 1, duration: reduceMotion ? 0.25 : 0.5, ease: easeOut },
						reduceMotion ? 0 : '-=0.45'
					);
				}
				if (hubEl) {
					processTl.to(
						hubEl,
						{ opacity: 1, scale: 1, duration: hubIn, ease: easeOut },
						reduceMotion ? 0 : '-=0.55'
					);
				}
				processTl.to(
					steps,
					{
						opacity: 1,
						duration: stepInDur,
						stagger: { each: stepStagger, from: 0 },
						ease: easeOut
					},
					reduceMotion ? 0 : '-=0.45'
				);
				if (stepFaces.length) {
					processTl.to(
						stepFaces,
						{
							scale: 1,
							duration: reduceMotion ? 0.4 : 0.72,
							stagger: { each: stepStagger, from: 0 },
							ease: easeOut
						},
						reduceMotion ? 0 : '-=0.72'
					);
				}
				if (sidePanel) {
					processTl.to(
						sidePanel,
						{ opacity: 1, x: 0, duration: reduceMotion ? 0.4 : 0.8, ease: easeOut },
						reduceMotion ? 0 : '-=0.55'
					);
				}
				processTl.to(
					panelEls,
					{
						opacity: 1,
						y: 0,
						duration: reduceMotion ? 0.35 : 0.65,
						stagger: panelStagger * 1.4,
						ease: easeOut
					},
					reduceMotion ? 0 : '-=0.5'
				);
			})();
		</script>

		<script>
			(function () {
				const section = document.querySelector('.achievements-section');
				if (!section || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

				const head = section.querySelector('.achieve-head');
				const coverflow = section.querySelector('#achieveCoverflow');
				const slides = section.querySelectorAll('.achieve-slide');
				const prevBtn = section.querySelector('.achieve-nav.prev');
				const nextBtn = section.querySelector('.achieve-nav.next');
				const lightbox = document.querySelector('#achieveLightbox');
				const lightboxImg = document.querySelector('#achieveLightboxImg');
				const lightboxTitle = document.querySelector('#achieveLightboxTitle');
				const lightboxClose = document.querySelector('.achieve-lightbox-close');
				if (!coverflow || !slides.length) return;

				let active = 0;
				let timer = null;
				let sectionInView = false;

				function startAutoIfVisible() {
					if (!sectionInView) return;
					startAuto();
				}

				function normalizeDiff(diff, total) {
					if (diff > total / 2) return diff - total;
					if (diff < -total / 2) return diff + total;
					return diff;
				}

				function getCoverflowMetrics() {
					const w = window.innerWidth || document.documentElement.clientWidth || 1024;
					if (w <= 480) {
						return {
							gap: Math.max(88, Math.min(118, Math.round(w * 0.29))),
							rot: 14,
							scale1: 0.88,
							scale2: 0.74
						};
					}
					if (w <= 767) {
						return {
							gap: Math.max(105, Math.min(148, Math.round(w * 0.31))),
							rot: 20,
							scale1: 0.85,
							scale2: 0.7
						};
					}
					if (w <= 991) {
						return { gap: 165, rot: 24, scale1: 0.82, scale2: 0.66 };
					}
					return { gap: 190, rot: 28, scale1: 0.82, scale2: 0.66 };
				}

				function layoutSlides() {
					const total = slides.length;
					const { gap, rot, scale1, scale2 } = getCoverflowMetrics();
					slides.forEach((slide, i) => {
						const raw = i - active;
						const diff = normalizeDiff(raw, total);
						const abs = Math.abs(diff);
						const tx = diff * gap;
						const scale = diff === 0 ? 1 : abs === 1 ? scale1 : scale2;
						const rotY = diff === 0 ? 0 : diff < 0 ? rot : -rot;
						const z = diff === 0 ? 30 : abs === 1 ? 20 : 10;
						const op = abs > 2 ? 0 : diff === 0 ? 1 : abs === 1 ? 0.65 : 0.28;

						slide.classList.toggle('is-active', diff === 0);
						slide.style.zIndex = String(z);
						slide.style.opacity = String(op);
						slide.style.filter = diff === 0 ? 'blur(0)' : 'blur(1.4px)';
						slide.style.transform = `translate(-50%, -50%) translateX(${tx}px) scale(${scale}) rotateY(${rotY}deg)`;
					});
				}

				let resizeTimer;
				window.addEventListener('resize', function () {
					clearTimeout(resizeTimer);
					resizeTimer = setTimeout(function () {
						layoutSlides();
					}, 100);
				});

				function goNext() {
					active = (active + 1) % slides.length;
					layoutSlides();
				}

				function goPrev() {
					active = (active - 1 + slides.length) % slides.length;
					layoutSlides();
				}

				function startAuto() {
					if (timer) clearInterval(timer);
					timer = setInterval(goNext, 4000);
				}

				function stopAuto() {
					if (!timer) return;
					clearInterval(timer);
					timer = null;
				}

				function openLightbox(slide) {
					if (!lightbox || !lightboxImg || !lightboxTitle) return;
					const img = slide.querySelector('img');
					const title = slide.querySelector('.achieve-slide-title');
					if (!img || !title) return;
					lightboxImg.src = img.currentSrc || img.src;
					lightboxImg.alt = img.alt || title.textContent.trim();
					lightboxTitle.textContent = title.textContent.trim();
					lightbox.classList.add('is-open');
					lightbox.setAttribute('aria-hidden', 'false');
					stopAuto();
				}

				function closeLightbox() {
					if (!lightbox) return;
					lightbox.classList.remove('is-open');
					lightbox.setAttribute('aria-hidden', 'true');
					startAutoIfVisible();
				}

				gsap.set(head, { y: 24, opacity: 0 });
				gsap.set(coverflow, { y: 20, opacity: 0 });
				layoutSlides();
				prevBtn && prevBtn.addEventListener('click', function () { stopAuto(); goPrev(); startAutoIfVisible(); });
				nextBtn && nextBtn.addEventListener('click', function () { stopAuto(); goNext(); startAutoIfVisible(); });
				prevBtn && prevBtn.addEventListener('touchstart', function (e) { e.preventDefault(); stopAuto(); goPrev(); startAutoIfVisible(); }, { passive: false });
				nextBtn && nextBtn.addEventListener('touchstart', function (e) { e.preventDefault(); stopAuto(); goNext(); startAutoIfVisible(); }, { passive: false });
				coverflow.addEventListener('mouseenter', stopAuto);
				coverflow.addEventListener('mouseleave', startAutoIfVisible);
				slides.forEach((slide) => {
					slide.addEventListener('click', function () {
						if (!slide.classList.contains('is-active')) return;
						openLightbox(slide);
					});
				});
				lightboxClose && lightboxClose.addEventListener('click', closeLightbox);
				lightbox && lightbox.addEventListener('click', function (e) {
					if (e.target === lightbox) closeLightbox();
				});
				document.addEventListener('keydown', function (e) {
					if (e.key === 'Escape' && lightbox && lightbox.classList.contains('is-open')) closeLightbox();
				});

				gsap.timeline({
					scrollTrigger: {
						trigger: section,
						start: 'top 80%',
						once: true
					}
				})
				.to(head, { y: 0, opacity: 1, duration: 0.7, ease: 'power2.out' })
				.to(coverflow, {
					y: 0,
					opacity: 1,
					duration: 0.7,
					ease: 'power2.out'
				}, '-=0.26');

				ScrollTrigger.create({
					trigger: section,
					start: 'top 75%',
					end: 'bottom 25%',
					onEnter: function () {
						sectionInView = true;
						startAuto();
					},
					onEnterBack: function () {
						sectionInView = true;
						startAuto();
					},
					onLeave: function () {
						sectionInView = false;
						stopAuto();
					},
					onLeaveBack: function () {
						sectionInView = false;
						stopAuto();
					}
				});
			})();
		</script>
		
		<script>
			(function () {
				if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

				/* ── Hero section entrance ── */
				var heroBadge = document.querySelector('.hero-badge');
				var heroTitle = document.querySelector('.hero-title');
				var heroAccent = document.querySelector('.hero-title-accent');
				var heroCanvas = document.querySelector('.hero-canvas-col');

				if (heroBadge) gsap.from(heroBadge, { opacity: 0, y: -20, duration: 0.6, delay: 0.3 });
				if (heroTitle) gsap.from(heroTitle, { opacity: 0, y: 40, duration: 0.8, delay: 0.5 });
				if (heroAccent) gsap.from(heroAccent, { opacity: 0, y: 30, duration: 0.7, delay: 0.8 });
				if (heroCanvas) gsap.from(heroCanvas, { opacity: 0, scale: 0.92, duration: 1, delay: 0.6, ease: 'power2.out' });

				/* ── Optimise section parallax on tags ── */
				var optimiseTags = document.querySelectorAll('.optimise-tag');
				if (optimiseTags.length) {
					gsap.fromTo(
						optimiseTags,
						{ opacity: 0, y: 20, scale: 0.85 },
						{
							opacity: 1,
							y: 0,
							scale: 1,
							duration: 0.5,
							stagger: 0.2,
							delay: 0.2,
							ease: 'back.out(1.4)',
							clearProps: 'opacity,transform',
							scrollTrigger: {
								trigger: '.optimise-section',
								start: 'top 80%',
								once: true
							}
						}
					);
				}

				/* ── Optimise visual parallax ── */
				var optimiseVisual = document.querySelector('.optimise-visual');
				if (optimiseVisual) {
					gsap.to(optimiseVisual, {
						scrollTrigger: { trigger: '.optimise-section', start: 'top bottom', end: 'bottom top', scrub: true },
						y: -26, ease: 'none'
					});
				}

				/* ── FSS process title slide ── */
				var fssTitle = document.querySelector('.fss-process-title');
				if (fssTitle) {
					gsap.from(fssTitle, {
						scrollTrigger: { trigger: '.fss-process-section', start: 'top 82%' },
						opacity: 0, x: -40, duration: 0.7
					});
				}

				/* ── FSS side panel slide in ── */
				var fssSidePanel = document.querySelector('.fss-side-panel');
				if (fssSidePanel) {
					gsap.from(fssSidePanel, {
						scrollTrigger: { trigger: '.fss-process-section', start: 'top 75%' },
						opacity: 0, x: 60, duration: 0.8, delay: 0.3
					});
				}

				/* ── CTA enhanced entrance ── */
				var cta = document.querySelector('#ctaPanel');
				if (cta) {
					gsap.set(cta, { y: 24, opacity: 0 });

					var ctaTl = gsap.timeline({
						scrollTrigger: { trigger: cta, start: 'top 84%', once: true }
					});
					ctaTl.to(cta, { y: 0, opacity: 1, duration: 0.75, ease: 'power2.out' });

					var ctaEyebrow = cta.querySelector('.cta-eyebrow');
					var ctaTitle = cta.querySelector('.cta-title');
					var ctaSub = cta.querySelector('.cta-sub');
					var ctaBtn = cta.querySelector('.cta-btn');

					if (ctaEyebrow) ctaTl.from(ctaEyebrow, { opacity: 0, y: 12, duration: 0.4 }, '-=0.3');
					if (ctaTitle) ctaTl.from(ctaTitle, { opacity: 0, y: 18, duration: 0.5 }, '-=0.2');
					if (ctaSub) ctaTl.from(ctaSub, { opacity: 0, y: 14, duration: 0.4 }, '-=0.15');
					if (ctaBtn) ctaTl.from(ctaBtn, { opacity: 0, y: 10, duration: 0.35 }, '-=0.1');
				}

				/* ── Parallax depth on hero ── */
				var heroTextCol = document.querySelector('.hero-text-col');
				if (heroTextCol) {
					gsap.to(heroTextCol, {
						scrollTrigger: { trigger: '.hero-section', start: 'top top', end: 'bottom top', scrub: true },
						y: 60, opacity: 0.3, ease: 'none'
					});
				}

				/* ── Section fade-in on scroll ── */
				document.querySelectorAll('.optimise-section, .fss-process-section, .cta-section').forEach(function(sec) {
					gsap.from(sec, {
						scrollTrigger: { trigger: sec, start: 'top 92%', toggleActions: 'play none none none' },
						opacity: 0.3, duration: 0.7
					});
				});
			})();
		</script>
	@endsection('scripts')

	@endsection('content')
