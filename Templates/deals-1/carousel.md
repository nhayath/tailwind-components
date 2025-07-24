# Sponsored Deals Carousel Documentation

## Overview

The Sponsored Deals Carousel is a responsive, interactive component that displays promotional deals in a sliding format. It adapts to different screen sizes and provides an optimal viewing experience across mobile, tablet, and desktop devices.

## Features

### Responsive Design
- **Mobile (< 768px)**: Shows 1 item per slide with 8 navigation indicators
- **Tablet (768px - 1023px)**: Shows 3 items per slide with 3 navigation indicators
- **Desktop (≥ 1024px)**: Shows 4 items per slide with 2 navigation indicators

### Navigation
- **Previous/Next Buttons**: Navigate between pages of deals
- **Indicator Dots**: Click to jump to specific pages
- **Auto-play**: Automatically advances every 5 seconds
- **Hover Pause**: Auto-play pauses when hovering over the carousel

### Smart Controls
- Navigation buttons and indicators are hidden when all items fit on screen
- Auto-play only activates when navigation is needed
- Responsive recalculation on window resize

## Technical Implementation

### HTML Structure

```html
<section class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
  <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
    <!-- Header with navigation buttons -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Sponsored Deals</h2>
      <div class="flex space-x-2">
        <button id="prevSlide">Previous</button>
        <button id="nextSlide">Next</button>
      </div>
    </div>
    
    <!-- Carousel container -->
    <div class="relative overflow-hidden">
      <div id="carouselTrack" class="flex transition-transform duration-300 ease-in-out">
        <!-- Deal items -->
      </div>
    </div>
    
    <!-- Indicators -->
    <div class="flex justify-center mt-4 space-x-2">
      <!-- Dynamically generated indicators -->
    </div>
  </div>
</section>
```

### JavaScript Configuration

#### Core Variables
```javascript
const totalSlides = 8;          // Total number of deal items
let slidesToShow = 1;           // Items visible per page (responsive)
let maxSlides = 0;              // Number of pages/indicators
let currentSlide = 0;           // Current page index
```

#### Responsive Breakpoints
```javascript
function updateSlidesToShow() {
  if (window.innerWidth >= 1024) {
    slidesToShow = 4;  // Desktop: 4 items
  } else if (window.innerWidth >= 768) {
    slidesToShow = 3;  // Tablet: 3 items
  } else {
    slidesToShow = 1;  // Mobile: 1 item
  }
  
  // Calculate number of pages
  maxSlides = Math.ceil(totalSlides / slidesToShow);
}
```

#### Page-based Navigation
```javascript
function updateCarousel() {
  // Calculate slides to move based on current page
  const slidesToMove = currentSlide * slidesToShow;
  const slideWidth = 100 / totalSlides;
  const translateX = -(slidesToMove * slideWidth);
  carouselTrack.style.transform = `translateX(${translateX}%)`;
}
```

### CSS Classes

#### Deal Item Structure
```css
.flex-none.w-full.md:w-1/3.lg:w-1/4.px-2 {
  /* Responsive width classes */
  /* Mobile: w-full (100%) */
  /* Tablet: md:w-1/3 (33.33%) */
  /* Desktop: lg:w-1/4 (25%) */
}
```

#### Carousel Track
```css
.flex.transition-transform.duration-300.ease-in-out {
  /* Smooth sliding animation */
  /* Flexbox layout for horizontal arrangement */
}
```

## API Reference

### Functions

#### `updateSlidesToShow()`
Recalculates responsive settings based on current window width.

#### `updateCarousel()`
Updates carousel position and indicator states.

#### `nextSlide()`
Navigates to the next page of deals.

#### `prevSlide()`
Navigates to the previous page of deals.

#### `goToSlide(slideIndex)`
Jumps to a specific page.

#### `startAutoPlay()`
Starts automatic slide progression (5-second intervals).

#### `stopAutoPlay()`
Stops automatic slide progression.

### Event Listeners

- **Navigation Buttons**: Click events for prev/next navigation
- **Indicators**: Click events for direct page navigation
- **Window Resize**: Recalculates responsive settings
- **Mouse Hover**: Pauses/resumes auto-play

## Customization

### Adding New Deals

1. Add new deal HTML structure to the carousel track
2. Update `totalSlides` variable in JavaScript
3. Indicators will automatically adjust

### Modifying Responsive Breakpoints

Edit the `updateSlidesToShow()` function:

```javascript
function updateSlidesToShow() {
  if (window.innerWidth >= 1200) {  // Custom breakpoint
    slidesToShow = 5;  // Show 5 items on large screens
  } else if (window.innerWidth >= 1024) {
    slidesToShow = 4;
  } else if (window.innerWidth >= 768) {
    slidesToShow = 3;
  } else {
    slidesToShow = 1;
  }
  
  maxSlides = Math.ceil(totalSlides / slidesToShow);
}
```

### Styling Deal Cards

Each deal card uses gradient backgrounds and follows this structure:

```html
<div class="bg-gradient-to-r from-[color1] to-[color2] rounded-lg p-4 text-white relative overflow-hidden">
  <div class="absolute top-2 right-2 bg-white text-[color] px-2 py-1 rounded text-xs font-bold">
    SPONSORED
  </div>
  <!-- Deal content -->
</div>
```

## Performance Considerations

- Uses CSS transforms for smooth hardware-accelerated animations
- Event listeners are properly cleaned up on resize
- Auto-play is conditionally enabled to reduce unnecessary processing
- Minimal DOM manipulation with efficient indicator generation

## Browser Support

- Modern browsers with CSS Grid and Flexbox support
- ES6+ JavaScript features (arrow functions, const/let)
- CSS custom properties and transforms
- Responsive design with CSS media queries

## Troubleshooting

### Common Issues

1. **Indicators not showing**: Check that `maxSlides > 1`
2. **Navigation not working**: Verify button IDs match JavaScript selectors
3. **Responsive issues**: Ensure Tailwind CSS classes are properly loaded
4. **Auto-play not stopping**: Check hover event listeners on carousel section

### Debug Tips

- Use browser dev tools to inspect `currentSlide` and `maxSlides` values
- Check console for JavaScript errors
- Verify CSS transforms are being applied to carousel track
- Test responsive behavior by resizing browser window