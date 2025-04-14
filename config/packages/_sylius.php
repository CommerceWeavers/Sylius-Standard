<?php

declare(strict_types=1);

use App\Entity\Addressing\Address;
use App\Entity\Addressing\Country;
use App\Entity\Addressing\Province;
use App\Entity\Addressing\Zone;
use App\Entity\Addressing\ZoneMember;
use App\Entity\Channel\Channel;
use App\Entity\Channel\ChannelPriceHistoryConfig;
use App\Entity\Channel\ChannelPricing;
use App\Entity\Channel\ChannelPricingLogEntry;
use App\Entity\Channel\ShopBillingData;
use App\Entity\Currency\Currency;
use App\Entity\Currency\ExchangeRate;
use App\Entity\Customer\Customer;
use App\Entity\Customer\CustomerGroup;
use App\Entity\Locale\Locale;
use App\Entity\Order\Adjustment;
use App\Entity\Order\Order;
use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderItemUnit;
use App\Entity\Order\OrderSequence;
use App\Entity\Payment\GatewayConfig;
use App\Entity\Payment\Payment;
use App\Entity\Payment\PaymentMethod;
use App\Entity\Payment\PaymentMethodTranslation;
use App\Entity\Payment\PaymentRequest;
use App\Entity\Payment\PaymentSecurityToken;
use App\Entity\Product\Product;
use App\Entity\Product\ProductAssociation;
use App\Entity\Product\ProductAssociationType;
use App\Entity\Product\ProductAssociationTypeTranslation;
use App\Entity\Product\ProductAttribute;
use App\Entity\Product\ProductAttributeTranslation;
use App\Entity\Product\ProductAttributeValue;
use App\Entity\Product\ProductImage;
use App\Entity\Product\ProductOption;
use App\Entity\Product\ProductOptionTranslation;
use App\Entity\Product\ProductOptionValue;
use App\Entity\Product\ProductOptionValueTranslation;
use App\Entity\Product\ProductReview;
use App\Entity\Product\ProductTaxon;
use App\Entity\Product\ProductTranslation;
use App\Entity\Product\ProductVariant;
use App\Entity\Product\ProductVariantTranslation;
use App\Entity\Promotion\CatalogPromotion;
use App\Entity\Promotion\CatalogPromotionAction;
use App\Entity\Promotion\CatalogPromotionScope;
use App\Entity\Promotion\CatalogPromotionTranslation;
use App\Entity\Promotion\Promotion;
use App\Entity\Promotion\PromotionAction;
use App\Entity\Promotion\PromotionCoupon;
use App\Entity\Promotion\PromotionRule;
use App\Entity\Promotion\PromotionTranslation;
use App\Entity\Shipping\Shipment;
use App\Entity\Shipping\ShippingCategory;
use App\Entity\Shipping\ShippingMethod;
use App\Entity\Shipping\ShippingMethodRule;
use App\Entity\Shipping\ShippingMethodTranslation;
use App\Entity\Taxation\TaxCategory;
use App\Entity\Taxation\TaxRate;
use App\Entity\Taxonomy\Taxon;
use App\Entity\Taxonomy\TaxonImage;
use App\Entity\Taxonomy\TaxonTranslation;
use App\Entity\User\AdminUser;
use App\Entity\User\AvatarImage;
use App\Entity\User\ShopUser;
use App\Entity\User\UserOAuth;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import('@SyliusCoreBundle/Resources/config/app/config.yml');

    $containerConfigurator->import('@SyliusPayumBundle/Resources/config/app/config.yaml');

    $containerConfigurator->import('@SyliusAdminBundle/Resources/config/app/config.yml');

    $containerConfigurator->import('@SyliusShopBundle/Resources/config/app/config.yml');

    $containerConfigurator->import('@SyliusApiBundle/Resources/config/app/config.yaml');

    $containerConfigurator->import(__DIR__ . '/../parameters.php');

    $parameters = $containerConfigurator->parameters();

    $parameters->set('sylius_core.public_dir', '%kernel.project_dir%/public');

    $containerConfigurator->extension('sylius_addressing', [
        'resources' => [
            'address' => [
                'classes' => [
                    'model' => Address::class,
                ],
            ],
            'country' => [
                'classes' => [
                    'model' => Country::class,
                ],
            ],
            'province' => [
                'classes' => [
                    'model' => Province::class,
                ],
            ],
            'zone' => [
                'classes' => [
                    'model' => Zone::class,
                ],
            ],
            'zone_member' => [
                'classes' => [
                    'model' => ZoneMember::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_attribute', [
        'resources' => [
            'product' => [
                'attribute' => [
                    'classes' => [
                        'model' => ProductAttribute::class,
                    ],
                    'translation' => [
                        'classes' => [
                            'model' => ProductAttributeTranslation::class,
                        ],
                    ],
                ],
                'attribute_value' => [
                    'classes' => [
                        'model' => ProductAttributeValue::class,
                    ],
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_channel', [
        'resources' => [
            'channel' => [
                'classes' => [
                    'model' => Channel::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_core', [
        'resources' => [
            'avatar_image' => [
                'classes' => [
                    'model' => AvatarImage::class,
                ],
            ],
            'product_image' => [
                'classes' => [
                    'model' => ProductImage::class,
                ],
            ],
            'taxon_image' => [
                'classes' => [
                    'model' => TaxonImage::class,
                ],
            ],
            'product_taxon' => [
                'classes' => [
                    'model' => ProductTaxon::class,
                ],
            ],
            'channel_pricing' => [
                'classes' => [
                    'model' => ChannelPricing::class,
                ],
            ],
            'channel_price_history_config' => [
                'classes' => [
                    'model' => ChannelPriceHistoryConfig::class,
                ],
            ],
            'channel_pricing_log_entry' => [
                'classes' => [
                    'model' => ChannelPricingLogEntry::class,
                ],
            ],
            'shop_billing_data' => [
                'classes' => [
                    'model' => ShopBillingData::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_currency', [
        'resources' => [
            'currency' => [
                'classes' => [
                    'model' => Currency::class,
                ],
            ],
            'exchange_rate' => [
                'classes' => [
                    'model' => ExchangeRate::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_customer', [
        'resources' => [
            'customer' => [
                'classes' => [
                    'model' => Customer::class,
                ],
            ],
            'customer_group' => [
                'classes' => [
                    'model' => CustomerGroup::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_locale', [
        'resources' => [
            'locale' => [
                'classes' => [
                    'model' => Locale::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_order', [
        'resources' => [
            'order' => [
                'classes' => [
                    'model' => Order::class,
                ],
            ],
            'order_item' => [
                'classes' => [
                    'model' => OrderItem::class,
                ],
            ],
            'order_item_unit' => [
                'classes' => [
                    'model' => OrderItemUnit::class,
                ],
            ],
            'adjustment' => [
                'classes' => [
                    'model' => Adjustment::class,
                ],
            ],
            'order_sequence' => [
                'classes' => [
                    'model' => OrderSequence::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_payment', [
        'resources' => [
            'payment_method' => [
                'classes' => [
                    'model' => PaymentMethod::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => PaymentMethodTranslation::class,
                    ],
                ],
            ],
            'payment' => [
                'classes' => [
                    'model' => Payment::class,
                ],
            ],
            'payment_request' => [
                'classes' => [
                    'model' => PaymentRequest::class,
                ],
            ],
            'gateway_config' => [
                'classes' => [
                    'model' => GatewayConfig::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_payum', [
        'resources' => [
            'payment_security_token' => [
                'classes' => [
                    'model' => PaymentSecurityToken::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_product', [
        'resources' => [
            'product' => [
                'classes' => [
                    'model' => Product::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => ProductTranslation::class,
                    ],
                ],
            ],
            'product_variant' => [
                'classes' => [
                    'model' => ProductVariant::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => ProductVariantTranslation::class,
                    ],
                ],
            ],
            'product_option' => [
                'classes' => [
                    'model' => ProductOption::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => ProductOptionTranslation::class,
                    ],
                ],
            ],
            'product_option_value' => [
                'classes' => [
                    'model' => ProductOptionValue::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => ProductOptionValueTranslation::class,
                    ],
                ],
            ],
            'product_association' => [
                'classes' => [
                    'model' => ProductAssociation::class,
                ],
            ],
            'product_association_type' => [
                'classes' => [
                    'model' => ProductAssociationType::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => ProductAssociationTypeTranslation::class,
                    ],
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_promotion', [
        'resources' => [
            'catalog_promotion' => [
                'classes' => [
                    'model' => CatalogPromotion::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => CatalogPromotionTranslation::class,
                    ],
                ],
            ],
            'catalog_promotion_action' => [
                'classes' => [
                    'model' => CatalogPromotionAction::class,
                ],
            ],
            'catalog_promotion_scope' => [
                'classes' => [
                    'model' => CatalogPromotionScope::class,
                ],
            ],
            'promotion' => [
                'classes' => [
                    'model' => Promotion::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => PromotionTranslation::class,
                    ],
                ],
            ],
            'promotion_rule' => [
                'classes' => [
                    'model' => PromotionRule::class,
                ],
            ],
            'promotion_action' => [
                'classes' => [
                    'model' => PromotionAction::class,
                ],
            ],
            'promotion_coupon' => [
                'classes' => [
                    'model' => PromotionCoupon::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_review', [
        'resources' => [
            'product' => [
                'review' => [
                    'classes' => [
                        'model' => ProductReview::class,
                    ],
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_shipping', [
        'resources' => [
            'shipment' => [
                'classes' => [
                    'model' => Shipment::class,
                ],
            ],
            'shipping_method' => [
                'classes' => [
                    'model' => ShippingMethod::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => ShippingMethodTranslation::class,
                    ],
                ],
            ],
            'shipping_method_rule' => [
                'classes' => [
                    'model' => ShippingMethodRule::class,
                ],
            ],
            'shipping_category' => [
                'classes' => [
                    'model' => ShippingCategory::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_taxation', [
        'resources' => [
            'tax_category' => [
                'classes' => [
                    'model' => TaxCategory::class,
                ],
            ],
            'tax_rate' => [
                'classes' => [
                    'model' => TaxRate::class,
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_taxonomy', [
        'resources' => [
            'taxon' => [
                'classes' => [
                    'model' => Taxon::class,
                ],
                'translation' => [
                    'classes' => [
                        'model' => TaxonTranslation::class,
                    ],
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_user', [
        'resources' => [
            'admin' => [
                'user' => [
                    'classes' => [
                        'model' => AdminUser::class,
                    ],
                ],
            ],
            'shop' => [
                'user' => [
                    'classes' => [
                        'model' => ShopUser::class,
                    ],
                ],
            ],
            'oauth' => [
                'user' => [
                    'classes' => [
                        'model' => UserOAuth::class,
                    ],
                ],
            ],
        ],
    ]);

    $containerConfigurator->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.base#stylesheets' => [
                'app_styles' => [
                    'template' => 'admin/stylesheets.html.twig',
                ],
            ],
            'sylius_admin.base#javascripts' => [
                'app_javascripts' => [
                    'template' => 'admin/javascripts.html.twig',
                ],
            ],
            'sylius_shop.base#stylesheets' => [
                'app_styles' => [
                    'template' => 'shop/stylesheets.html.twig',
                ],
            ],
            'sylius_shop.base#javascripts' => [
                'app_javascripts' => [
                    'template' => 'shop/javascripts.html.twig',
                ],
            ],
        ],
    ]);
};
