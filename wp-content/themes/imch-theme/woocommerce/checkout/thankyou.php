<?php
/**
 * Thank You / Order Received Confirmation Template - Intermobile Containers Hub
 * High-Converting, Reassuring Industrial Design
 *
 * @package IMCH
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order imch-confirmation-page">

    <?php if ( $order ) : ?>

        <?php do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <div class="imch-order-failed-card">
                <div class="imch-failed-icon">⚠️</div>
                <h2><?php esc_html_e( 'Order Payment Failed', 'imch' ); ?></h2>
                <p><?php esc_html_e( 'Unfortunately your order payment could not be processed. Please try again with an alternative payment method or contact our dispatch team.', 'imch' ); ?></p>
                <div class="imch-failed-actions">
                    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="imch-btn imch-btn-primary">
                        <?php esc_html_e( 'Retry Payment', 'imch' ); ?>
                    </a>
                    <a href="<?php echo esc_url( imch_whatsapp_url( 'Hello, I had trouble with my payment for Order #' . $order->get_id() ) ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp">
                        <span><?php esc_html_e( 'Help on WhatsApp', 'imch' ); ?></span>
                    </a>
                </div>
            </div>

        <?php else : ?>

            <?php
            $site_type  = get_post_meta( $order->get_id(), '_delivery_site_type', true );
            $surface    = get_post_meta( $order->get_id(), '_delivery_surface', true );
            $clearance  = get_post_meta( $order->get_id(), '_delivery_access_clearance', true );

            $site_types = array(
                'commercial'  => 'Commercial / Warehouse / Industrial Depot',
                'residential' => 'Residential / Private Property / Farm',
                'jobsite'     => 'Active Construction Site',
                'other'       => 'Other Location (Special Access)',
            );
            $surfaces = array(
                'concrete' => 'Paved Concrete or Asphalt',
                'gravel'   => 'Packed Gravel or Crushed Stone',
                'dirt'     => 'Dry Dirt / Grass / Pasture',
            );
            $clearances = array(
                'ample' => 'Clear straight path (60ft+ for 20ft / 100ft+ for 40ft)',
                'tight' => 'Tight corners / Narrow gate (Coordination needed)',
            );
            ?>

            <!-- ==============================================================
                 STRICT CORPORATE INVOICE TEMPLATE (VISIBLE ONLY DURING PRINT)
                 Zero extraneous web UI, zero buttons, strictly formal invoice.
                 ============================================================== -->
            <div class="imch-print-invoice-sheet" aria-hidden="true">
                <!-- Invoice Corporate Header -->
                <div class="imch-inv-header">
                    <div class="imch-inv-brand">
                        <div class="imch-inv-logo-mark">INTERMOBILE CONTAINERS HUB</div>
                        <div class="imch-inv-brand-tagline">Nationwide ISO Container Sales, Depot Depot Storage &amp; Intermodal Freight</div>
                        <div class="imch-inv-brand-details">
                            <div><strong>Depot Operations:</strong> <?php echo esc_html( IMCH_ADDRESS ); ?></div>
                            <div><strong>Dispatch / Accounting:</strong> <?php echo esc_html( IMCH_PHONE ); ?> &bull; <strong>Email:</strong> <?php echo esc_html( IMCH_EMAIL ); ?></div>
                            <div><strong>Website:</strong> https://intermobilecontainershub.com</div>
                        </div>
                    </div>
                    <div class="imch-inv-meta-card">
                        <h1 class="imch-inv-doc-title">OFFICIAL COMMERCIAL INVOICE</h1>
                        <table class="imch-inv-meta-table">
                            <tr>
                                <th>Invoice / Order Ref:</th>
                                <td><strong>#<?php echo esc_html( $order->get_order_number() ); ?></strong></td>
                            </tr>
                            <tr>
                                <th>Date Issued:</th>
                                <td><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></td>
                            </tr>
                            <tr>
                                <th>Order Status:</th>
                                <td><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></td>
                            </tr>
                            <tr>
                                <th>Settlement Channel:</th>
                                <td><?php echo esc_html( wp_strip_all_tags( $order->get_payment_method_title() ) ); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Sold To / Delivery Logistics 2-Col Grid -->
                <div class="imch-inv-parties-grid">
                    <div class="imch-inv-party-col">
                        <h2 class="imch-inv-section-title">SOLD &amp; BILLED TO</h2>
                        <div class="imch-inv-party-body">
                            <strong class="imch-inv-name"><?php echo esc_html( $order->get_formatted_billing_full_name() ); ?></strong>
                            <?php if ( $order->get_billing_company() ) : ?>
                                <div class="imch-inv-company"><?php echo esc_html( $order->get_billing_company() ); ?></div>
                            <?php endif; ?>
                            <div class="imch-inv-addr-line"><?php echo esc_html( $order->get_billing_address_1() ); ?></div>
                            <?php if ( $order->get_billing_address_2() ) : ?>
                                <div class="imch-inv-addr-line"><?php echo esc_html( $order->get_billing_address_2() ); ?></div>
                            <?php endif; ?>
                            <div class="imch-inv-addr-line"><?php echo esc_html( $order->get_billing_city() . ', ' . $order->get_billing_state() . ' ' . $order->get_billing_postcode() ); ?></div>
                            <div class="imch-inv-addr-line"><?php echo esc_html( $order->get_billing_country() ); ?></div>
                            <div class="imch-inv-contact-row">
                                <span><strong>Phone:</strong> <?php echo esc_html( $order->get_billing_phone() ?: 'Provided to Dispatch' ); ?></span><br>
                                <span><strong>Email:</strong> <?php echo esc_html( $order->get_billing_email() ); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="imch-inv-party-col">
                        <h2 class="imch-inv-section-title">DELIVERY SITE SPECIFICATIONS</h2>
                        <div class="imch-inv-party-body">
                            <table class="imch-inv-specs-table">
                                <tr>
                                    <th>Destination Site:</th>
                                    <td><?php echo esc_html( $order->get_billing_city() . ', ' . $order->get_billing_state() . ' ' . $order->get_billing_postcode() ); ?></td>
                                </tr>
                                <tr>
                                    <th>Classification:</th>
                                    <td><?php echo esc_html( $site_types[ $site_type ] ?? ( $site_type ?: 'Commercial / Private Site' ) ); ?></td>
                                </tr>
                                <tr>
                                    <th>Ground Surface:</th>
                                    <td><?php echo esc_html( $surfaces[ $surface ] ?? ( $surface ?: 'Paved / Packed Ground' ) ); ?></td>
                                </tr>
                                <tr>
                                    <th>Truck Clearance:</th>
                                    <td><?php echo esc_html( $clearances[ $clearance ] ?? ( $clearance ?: 'Straight Clear Line' ) ); ?></td>
                                </tr>
                                <tr>
                                    <th>Trailer Drop Mode:</th>
                                    <td>Standard Hydraulic Roll-off Tilt-Bed (Ground Drop)</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Itemized Container Specification Table -->
                <table class="imch-inv-items-table">
                    <thead>
                        <tr>
                            <th class="imch-inv-th-num">#</th>
                            <th class="imch-inv-th-desc">Unit Description &amp; ISO Specifications</th>
                            <th class="imch-inv-th-price">Unit Price</th>
                            <th class="imch-inv-th-qty">Qty</th>
                            <th class="imch-inv-th-total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item_idx = 1;
                        foreach ( $order->get_items() as $item_id => $item ) :
                            $product = $item->get_product();
                            $qty = max( 1, $item->get_quantity() );
                            $unit_price = $product ? $order->get_item_subtotal( $item, false, false ) : ( $item->get_subtotal() / $qty );
                        ?>
                            <tr>
                                <td class="imch-inv-td-num"><?php echo esc_html( $item_idx++ ); ?></td>
                                <td class="imch-inv-td-desc">
                                    <strong class="imch-inv-item-title"><?php echo esc_html( $item->get_name() ); ?></strong>
                                    <div class="imch-inv-item-sub">Heavy Corten Anti-Corrosion Steel &bull; Wind &amp; Watertight (WWT) / CSC Certified &bull; Marine Flooring</div>
                                </td>
                                <td class="imch-inv-td-price"><?php echo wp_kses_post( wc_price( $unit_price ) ); ?></td>
                                <td class="imch-inv-td-qty"><?php echo esc_html( $item->get_quantity() ); ?></td>
                                <td class="imch-inv-td-total"><?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="imch-inv-empty-cell"></td>
                            <th class="imch-inv-sum-label">Container Subtotal:</th>
                            <td class="imch-inv-sum-val"><?php echo wp_kses_post( wc_price( $order->get_subtotal() ) ); ?></td>
                        </tr>
                        <?php foreach ( $order->get_fees() as $fee_id => $fee ) : ?>
                            <tr class="imch-inv-discount-row">
                                <td colspan="3" class="imch-inv-empty-cell"></td>
                                <th class="imch-inv-sum-label"><?php echo esc_html( $fee->get_name() ); ?>:</th>
                                <td class="imch-inv-sum-val"><?php echo wp_kses_post( wc_price( $fee->get_total() ) ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if ( $order->get_shipping_total() > 0 ) : ?>
                            <tr>
                                <td colspan="3" class="imch-inv-empty-cell"></td>
                                <th class="imch-inv-sum-label">Tilt-Bed Delivery Freight:</th>
                                <td class="imch-inv-sum-val"><?php echo wp_kses_post( wc_price( $order->get_shipping_total() ) ); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr class="imch-inv-grand-total-row">
                            <td colspan="3" class="imch-inv-empty-cell"></td>
                            <th class="imch-inv-sum-label imch-inv-total-text">FINAL INVOICE TOTAL:</th>
                            <td class="imch-inv-sum-val imch-inv-total-amount"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Remittance Instructions & Terms -->
                <div class="imch-inv-footer-layout">
                    <div class="imch-inv-remittance-col">
                        <h3 class="imch-inv-subhead">SETTLEMENT &amp; REMITTANCE INSTRUCTIONS</h3>
                        <div class="imch-inv-remittance-body">
                            <p>
                                Please reference <strong>Order #<?php echo esc_html( $order->get_order_number() ); ?></strong> on your payment remittance memo.
                                For official wire routing numbers, ACH commercial clearance, or instant digital settlement confirmation, contact our accounting desk directly at <strong><?php echo esc_html( IMCH_PHONE ); ?></strong> or email <strong><?php echo esc_html( IMCH_EMAIL ); ?></strong>.
                            </p>
                        </div>

                        <h3 class="imch-inv-subhead" style="margin-top: 10px;">DELIVERY &amp; SITE REQUIREMENTS</h3>
                        <ul class="imch-inv-terms-list">
                            <li>Tilt-bed roll-off trailers require a straight line driving path of 60-70 ft for 20ft units and 100-120 ft for 40ft units.</li>
                            <li>Minimum 14 ft overhead clearance required during transport, and 16-20 ft during trailer bed elevation.</li>
                            <li>Delivery location must be firm, dry, and level (compacted gravel, concrete, asphalt, or solid dry dirt).</li>
                            <li>All containers are thoroughly inspected and guaranteed wind &amp; watertight per ISO maritime standards.</li>
                        </ul>
                    </div>

                    <div class="imch-inv-signature-col">
                        <div class="imch-inv-sig-box">
                            <span class="imch-inv-sig-label">Authorized Logistics Dispatcher:</span>
                            <div class="imch-inv-sig-line"></div>
                            <span class="imch-inv-sig-title">Intermobile Containers Hub Dispatch Operations</span>
                        </div>
                        <div class="imch-inv-sig-box" style="margin-top: 20px;">
                            <span class="imch-inv-sig-label">Customer Receiving Representative:</span>
                            <div class="imch-inv-sig-line"></div>
                            <span class="imch-inv-sig-title">Authorized Signature &amp; Date Received</span>
                        </div>
                    </div>
                </div>

                <!-- Bottom Document Stamp -->
                <div class="imch-inv-doc-stamp">
                    Official Corporate Invoice &bull; <?php echo esc_html( IMCH_NAME ); ?> &bull; 11500 Metric Blvd, Austin, TX 78758 &bull; <?php echo esc_html( IMCH_PHONE ); ?>
                </div>
            </div>

            <!-- Confirmation Success Header Hero -->
            <div class="imch-confirmation-hero">
                <div class="imch-conf-check-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="imch-conf-hero-text">
                    <span class="imch-conf-kicker" style="color: #86EFAC !important; display: inline-block; font-weight: 800;"><?php esc_html_e( 'Order Received • Container Reservation Active', 'imch' ); ?></span>
                    <h2 class="imch-conf-title" style="color: #FFFFFF !important;">
                        <?php esc_html_e( 'Thank You! Your Order is Confirmed', 'imch' ); ?>
                    </h2>
                    <p class="imch-conf-lead" style="color: #E2E8F0 !important;">
                        <?php printf( esc_html__( 'A confirmation receipt has been sent to %s. Your container is on hold at our dispatch depot while settlement is finalized.', 'imch' ), '<strong style="color: #FFFFFF !important;">' . esc_html( $order->get_billing_email() ) . '</strong>' ); ?>
                    </p>
                </div>
            </div>

            <!-- Quick Overview 3-Stat Strip -->
            <div class="imch-order-stats-strip">
                <div class="imch-stat-box">
                    <span class="imch-stat-label"><?php esc_html_e( 'Date Placed', 'imch' ); ?></span>
                    <strong class="imch-stat-value"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong>
                </div>
                <div class="imch-stat-box">
                    <span class="imch-stat-label"><?php esc_html_e( 'Settlement Method', 'imch' ); ?></span>
                    <strong class="imch-stat-value imch-payment-highlight"><?php echo esc_html( wp_strip_all_tags( $order->get_payment_method_title() ) ); ?></strong>
                </div>
                <div class="imch-stat-box">
                    <span class="imch-stat-label"><?php esc_html_e( 'Total Amount', 'imch' ); ?></span>
                    <strong class="imch-stat-value imch-price-highlight"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
                </div>
            </div>

            <!-- Next Steps & WhatsApp Coordination Card (Hooked via imch_order_thankyou_next_steps) -->
            <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

            <!-- Container Order Items & Delivery Breakdown Table -->
            <div class="imch-confirmation-details-card">
                <h3 class="imch-details-card-title"><?php esc_html_e( 'Container Order Specification', 'imch' ); ?></h3>
                
                <div class="imch-table-responsive imch-order-table-responsive">
                    <table class="imch-order-summary-table">
                        <thead>
                            <tr>
                                <th><?php esc_html_e( 'Unit Description', 'imch' ); ?></th>
                                <th class="imch-text-right"><?php esc_html_e( 'Quantity', 'imch' ); ?></th>
                                <th class="imch-text-right"><?php esc_html_e( 'Line Total', 'imch' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                                <tr>
                                    <td>
                                        <strong class="imch-order-item-name"><?php echo esc_html( $item->get_name() ); ?></strong>
                                        <div class="imch-order-item-meta">
                                            <span>✓ CSC Certified • Inspected Unit</span>
                                        </div>
                                    </td>
                                    <td class="imch-text-right">
                                        <span class="imch-item-qty">&times; <?php echo esc_html( $item->get_quantity() ); ?></span>
                                    </td>
                                    <td class="imch-text-right">
                                        <strong class="imch-item-subtotal"><?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?></strong>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2"><?php esc_html_e( 'Subtotal', 'imch' ); ?></th>
                                <td class="imch-text-right"><?php echo wp_kses_post( wc_price( $order->get_subtotal() ) ); ?></td>
                            </tr>

                            <?php foreach ( $order->get_fees() as $fee_id => $fee ) : ?>
                                <tr class="imch-conf-fee-row">
                                    <th colspan="2">
                                        <span><?php echo esc_html( $fee->get_name() ); ?></span>
                                        <span class="imch-badge-savings">DISCOUNT APPLIED</span>
                                    </th>
                                    <td class="imch-text-right imch-green-text">
                                        <?php echo wp_kses_post( wc_price( $fee->get_total() ) ); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if ( $order->get_shipping_total() > 0 ) : ?>
                                <tr>
                                    <th colspan="2"><?php esc_html_e( 'Delivery Freight', 'imch' ); ?></th>
                                    <td class="imch-text-right"><?php echo wp_kses_post( wc_price( $order->get_shipping_total() ) ); ?></td>
                                </tr>
                            <?php endif; ?>

                            <tr class="imch-conf-total-row">
                                <th colspan="2"><?php esc_html_e( 'Final Order Total', 'imch' ); ?></th>
                                <td class="imch-text-right">
                                    <strong class="imch-conf-final-price"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Customer & Delivery Site Logistics Cards Grid -->
            <div class="imch-confirmation-logistics-grid">
                <!-- Delivery Site Details -->
                <div class="imch-logistics-card">
                    <h4>📍 <?php esc_html_e( 'Delivery Site Access Specifications', 'imch' ); ?></h4>
                    <div class="imch-logistics-content">
                        <ul class="imch-logistics-list">
                            <li>
                                <strong>Site Classification:</strong>
                                <span><?php echo esc_html( $site_types[ $site_type ] ?? ( $site_type ?: 'Standard Site' ) ); ?></span>
                            </li>
                            <li>
                                <strong>Ground Surface:</strong>
                                <span><?php echo esc_html( $surfaces[ $surface ] ?? ( $surface ?: 'Paved / Packed Ground' ) ); ?></span>
                            </li>
                            <li>
                                <strong>Truck Access Clearance:</strong>
                                <span><?php echo esc_html( $clearances[ $clearance ] ?? ( $clearance ?: 'Straight Path' ) ); ?></span>
                            </li>
                            <li>
                                <strong>Trailer Type:</strong>
                                <span>Standard Hydraulic Tilt-Bed (Ground Drop)</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Customer Billing & Delivery Contact -->
                <div class="imch-logistics-card">
                    <h4>👤 <?php esc_html_e( 'Customer & Delivery Contact', 'imch' ); ?></h4>
                    <div class="imch-logistics-content">
                        <address class="imch-customer-address">
                            <strong><?php echo esc_html( $order->get_formatted_billing_full_name() ); ?></strong><br>
                            <?php if ( $order->get_billing_company() ) : ?>
                                <?php echo esc_html( $order->get_billing_company() ); ?><br>
                            <?php endif; ?>
                            <?php echo esc_html( $order->get_billing_address_1() ); ?><br>
                            <?php if ( $order->get_billing_address_2() ) : ?>
                                <?php echo esc_html( $order->get_billing_address_2() ); ?><br>
                            <?php endif; ?>
                            <?php echo esc_html( $order->get_billing_city() . ', ' . $order->get_billing_state() . ' ' . $order->get_billing_postcode() ); ?><br>
                            <?php echo esc_html( $order->get_billing_country() ); ?>
                        </address>
                        <div class="imch-contact-quick-info">
                            <div>📞 <strong>Phone:</strong> <?php echo esc_html( $order->get_billing_phone() ?: 'Provided via WhatsApp' ); ?></div>
                            <div>✉️ <strong>Email:</strong> <?php echo esc_html( $order->get_billing_email() ); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Action Row -->
            <div class="imch-confirmation-footer-actions">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-outline">
                    &larr; <?php esc_html_e( 'Return to Container Catalog', 'imch' ); ?>
                </a>
                <button type="button" class="imch-btn imch-btn-ghost" onclick="window.print();">
                    🖨️ <?php esc_html_e( 'Print Official Order Receipt', 'imch' ); ?>
                </button>
            </div>

        <?php endif; ?>

    <?php else : ?>

        <div class="imch-empty-cart-card">
            <h2><?php esc_html_e( 'Order Not Found', 'imch' ); ?></h2>
            <p><?php esc_html_e( 'Thank you. Please check your email for order status or browse our containers catalog.', 'imch' ); ?></p>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-primary">
                <?php esc_html_e( 'Browse Containers', 'imch' ); ?>
            </a>
        </div>

    <?php endif; ?>

</div>
