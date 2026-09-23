<?php get_header(); ?>

<main id="top" class="site-main">

<section class="hero">
<div class="hero-grid"></div>
<div class="container">
<div class="hero-content">

<span class="eyebrow">Independent digital solutions team</span>

<h1>Digital experiences that move your business forward.</h1>

<p class="lead">
We design modern websites and digital solutions that help businesses build credibility, reach more customers and grow online.
</p>

<div class="hero-actions">
<a class="btn btn-primary" href="#contact">Start a Project →</a>
<a class="btn btn-glass" href="#services">Explore Services</a>
</div>

<div class="stats">
<div class="glass stat">
<strong>2 Web Developers</strong>
<span>Design and development expertise.</span>
</div>

<div class="glass stat">
<strong>1 Marketing Specialist</strong>
<span>Strategy, campaigns and growth.</span>
</div>

<div class="glass stat">
<strong>One Focused Team</strong>
<span>Direct, remote collaboration.</span>
</div>
</div>

</div>
</div>
</section>


<section id="services" class="section">
<div class="container">

<div class="section-head">
<div class="eyebrow-text">What we do</div>
<h2>Digital capability, built around your business.</h2>
<p>
From a first website to ongoing digital growth, we bring the essential disciplines together in one focused team.
</p>
</div>

<div class="grid-3">

<?php
$services = post_type_exists('magna_service')
    ? get_posts(
        array(
            'post_type'      => 'magna_service',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        )
    )
    : array();

if ($services) :

    $i = 0;

    foreach ($services as $service) :

        $i++;
?>

<article class="glass card">

<span class="service-number">
0<?php echo $i; ?>
</span>

<div class="service-icon">✦</div>

<h3>
<?php echo esc_html(get_the_title($service)); ?>
</h3>

<p>
<?php
echo esc_html(
    wp_trim_words(
        get_post_field('post_content', $service),
        28
    )
);
?>
</p>

</article>

<?php
    endforeach;

else :

    foreach (magna_fallback_services() as $i => $item) :
?>

<article class="glass card">

<span class="service-number">
0<?php echo $i + 1; ?>
</span>

<div class="service-icon">✦</div>

<h3>
<?php echo esc_html($item[0]); ?>
</h3>

<p>
<?php echo esc_html($item[1]); ?>
</p>

</article>

<?php
    endforeach;

endif;
?>

</div>
</div>
</section>


<section id="why" class="section section-alt">
<div class="container why-layout">

<div class="section-head">

<div class="eyebrow-text">Why MAGNA Tech</div>

<h2>Small by design. Serious about the work.</h2>

<p>
Our compact team keeps communication direct and every decision connected to the people doing the work.
</p>

</div>

<div>

<div class="why-item">
<div class="mini-icon">◈</div>
<h3>Direct collaboration</h3>
<p>
Work directly with the specialists responsible for your website and marketing.
</p>
</div>

<div class="why-item">
<div class="mini-icon">◈</div>
<h3>Connected thinking</h3>
<p>
Design, development and marketing are considered as one digital system.
</p>
</div>

<div class="why-item">
<div class="mini-icon">◈</div>
<h3>Dependable delivery</h3>
<p>
Clear stages, honest scope and maintainable work designed for the long term.
</p>
</div>

<div class="why-item">
<div class="mini-icon">◈</div>
<h3>Business-first decisions</h3>
<p>
Every creative and technical choice starts with your audience and goals.
</p>
</div>

</div>
</div>
</section>


<section id="process" class="section">
<div class="container">

<div class="section-head">
<div class="eyebrow-text">Our process</div>
<h2>A clear path from first conversation to launch.</h2>
</div>

<div class="process">

<div class="process-card">
<span class="num">01</span>
<h3>Discover</h3>
<p>
We understand your business, audience, objectives and current digital position.
</p>
</div>

<div class="process-card">
<span class="num">02</span>
<h3>Define</h3>
<p>
We shape the scope, content structure and visual direction before production begins.
</p>
</div>

<div class="process-card">
<span class="num">03</span>
<h3>Create</h3>
<p>
Design, development and review move together through clear, focused stages.
</p>
</div>

<div class="process-card">
<span class="num">04</span>
<h3>Launch &amp; Grow</h3>
<p>
We launch carefully, then support the next stage through maintenance and marketing.
</p>
</div>

</div>
</div>
</section>


<section id="work" class="section section-alt">
<div class="container">

<div class="section-head">
<div class="eyebrow-text">Our work</div>

<h2>Built for real business needs, not a showcase reel.</h2>

<p>
We do not publish invented case studies. These are the practical engagement types our team is equipped to deliver.
</p>
</div>

<div class="grid-3">

<?php
$projects = post_type_exists('magna_project')
    ? get_posts(
        array(
            'post_type'      => 'magna_project',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        )
    )
    : array();

if ($projects) :

    foreach ($projects as $project) :
?>

<article class="glass card work-card">

<div style="width:56px;height:2px;background:var(--primary)"></div>

<h3>
<?php echo esc_html(get_the_title($project)); ?>
</h3>

<p>
<?php
echo esc_html(
    wp_trim_words(
        get_post_field('post_content', $project),
        32
    )
);
?>
</p>

</article>

<?php
    endforeach;

else :

    foreach (magna_fallback_projects() as $item) :
?>

<article class="glass card work-card">

<div style="width:56px;height:2px;background:var(--primary)"></div>

<h3>
<?php echo esc_html($item[0]); ?>
</h3>

<p>
<?php echo esc_html($item[1]); ?>
</p>

<div class="tags">

<?php foreach ($item[2] as $tag) : ?>

<span class="tag">
<?php echo esc_html($tag); ?>
</span>

<?php endforeach; ?>

</div>

</article>

<?php
    endforeach;

endif;
?>

</div>
</div>
</section>


<section id="testimonials" class="section section-alt">
<div class="container">

<div class="section-head">

<div class="eyebrow-text">Client feedback</div>

<h2>What clients say about working with us.</h2>

<p>
Real feedback can be added here as your projects go live.
</p>

</div>

<div class="grid-3 testimonials-grid">

<?php
$testimonials = post_type_exists('magna_testimonial')
    ? get_posts(
        array(
            'post_type'      => 'magna_testimonial',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC'
        )
    )
    : array();

if ($testimonials) :

    foreach ($testimonials as $testimonial) :
?>

<article class="glass card testimonial-card">

<div class="testimonial-mark">“</div>

<p class="testimonial-quote">
<?php
echo esc_html(
    wp_strip_all_tags(
        get_post_field(
            'post_content',
            $testimonial
        )
    )
);
?>
</p>

<div class="testimonial-author">

<strong>
<?php echo esc_html(get_the_title($testimonial)); ?>
</strong>

<span>Client</span>

</div>

</article>

<?php
    endforeach;

else :
?>

<article class="glass card testimonial-card">

<div class="testimonial-mark">“</div>

<p class="testimonial-quote">
Client testimonials will appear here once they are added in WordPress.
</p>

<div class="testimonial-author">

<strong>MAGNA Tech</strong>

<span>Digital solutions team</span>

</div>

</article>

<?php endif; ?>

</div>
</div>
</section>


<section id="marketing" class="section">
<div class="container marketing-layout">

<div>

<div class="section-head">

<div class="eyebrow-text">Digital marketing</div>

<h2>A strong website is the start, not the finish.</h2>

<p>
Our marketing specialist helps turn your digital presence into an active growth channel through focused planning, campaigns, content and ongoing refinement.
</p>

</div>

<a
class="btn btn-glass"
style="margin-top:28px"
href="#contact"
>
Discuss your growth goals →
</a>

</div>

<div class="glass marketing-list">

<div class="marketing-item">
<span class="check">✓</span>
<span>Strategy shaped around your business and audience</span>
</div>

<div class="marketing-item">
<span class="check">✓</span>
<span>Campaign planning with clear priorities</span>
</div>

<div class="marketing-item">
<span class="check">✓</span>
<span>Consistent social content and management</span>
</div>

<div class="marketing-item">
<span class="check">✓</span>
<span>Ongoing review and practical improvements</span>
</div>

</div>
</div>
</section>


<section id="contact" class="section" style="padding-top:30px">

<div class="container">

<div class="glass cta technical-grid">

<div class="cta-content">

<div class="eyebrow">
Start a conversation
</div>

<h2>
Ready to move your business forward?
</h2>

<p class="lead" style="font-size:16px">
Tell us what you are building, redesigning or trying to grow. We will help you identify the clearest next step.
</p>


<?php if (isset($_GET['enquiry']) && $_GET['enquiry'] === 'sent'): ?>

<div class="notice enquiry-success" role="alert">
    <strong>✓ Enquiry sent successfully!</strong>
    <span>Thank you. We have received your project enquiry and will get back to you soon.</span>
</div>

<?php elseif (isset($_GET['enquiry']) && $_GET['enquiry'] === 'error'): ?>

<div class="notice enquiry-error" role="alert">
    <strong>Something went wrong.</strong>
    <span>Please check your details and try again.</span>
</div>

<?php endif; ?>


<form
class="contact-form"
action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
method="post"
>

<input
type="hidden"
name="action"
value="magna_submit_enquiry"
>

<?php
wp_nonce_field(
    'magna_enquiry',
    'magna_nonce'
);
?>


<!-- NAME + EMAIL -->

<div class="row">

<input
required
name="name"
placeholder="Your name"
>

<input
required
type="email"
name="email"
placeholder="Email address"
>

</div>


<!-- COMPANY + PHONE -->

<div class="row">

<input
name="company"
placeholder="Company"
>

<div class="phone-group">

<select name="country_code" class="country-code" aria-label="Country code">

<option value="+91">🇮🇳 +91 India</option>
<option value="+1">🇺🇸 +1 USA</option>
<option value="+44">🇬🇧 +44 UK</option>
<option value="+971">🇦🇪 +971 UAE</option>
<option value="+65">🇸🇬 +65 Singapore</option>
<option value="+61">🇦🇺 +61 Australia</option>
<option value="+49">🇩🇪 +49 Germany</option>
<option value="+33">🇫🇷 +33 France</option>
<option value="+31">🇳🇱 +31 Netherlands</option>

</select>

<input
type="tel"
name="phone"
placeholder="Phone number"
inputmode="tel"
maxlength="15"
>

</div>

</div>


<!-- SERVICE -->

<select name="service">

<option value="">
Service you need
</option>

<option>
Website Design & Development
</option>

<option>
Redesign & Modernization
</option>

<option>
Website Maintenance
</option>

<option>
Digital Marketing
</option>

<option>
Social Media Management
</option>

<option>
Digital Growth Solutions
</option>

</select>


<!-- BUDGET -->

<div class="budget-field">

<label class="budget-label">
Estimated Project Budget
</label>

<p class="budget-help">
Choose your currency and enter your estimated budget.
</p>


<!-- CURRENCY -->

<div class="budget-currency">

<label class="currency-option">

<input
type="radio"
name="budget_currency"
value="USD"
>

<span>
$ USD
</span>

</label>


<label class="currency-option">

<input
type="radio"
name="budget_currency"
value="INR"
>

<span>
₹ INR
</span>

</label>


<label class="currency-option">

<input
type="radio"
name="budget_currency"
value="EUR"
>

<span>
€ EUR
</span>

</label>

</div>


<!-- AMOUNT -->

<input
class="budget-amount"
type="number"
name="budget_amount"
min="0"
step="0.01"
placeholder="Enter your estimated budget"
>


<!-- NOT SURE -->

<label class="budget-not-sure">

<input
type="checkbox"
name="budget_not_sure"
value="1"
>

<span>
I'm not sure about my budget
</span>

</label>

</div>


<!-- MESSAGE -->

<textarea
required
name="message"
placeholder="Tell us about your project"
></textarea>


<!-- SUBMIT -->

<button
class="btn btn-primary"
type="submit"
>
Send Project Enquiry →
</button>

</form>

</div>
</div>
</div>

</section>

</main>

<?php get_footer(); ?>