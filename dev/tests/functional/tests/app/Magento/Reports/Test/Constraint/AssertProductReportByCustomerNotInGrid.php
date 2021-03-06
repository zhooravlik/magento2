<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Reports\Test\Constraint;

use Magento\Catalog\Test\Fixture\CatalogProductSimple;
use Magento\Customer\Test\Fixture\CustomerInjectable;
use Magento\Reports\Test\Page\Adminhtml\CustomerReportReview;
use Magento\Review\Test\Constraint\AssertProductReviewNotInGrid;
use Magento\Review\Test\Fixture\ReviewInjectable;
use Magento\Review\Test\Page\Adminhtml\ReviewIndex;
use Mtf\Constraint\AbstractConstraint;

/**
 * Class AssertProductReportByCustomerNotInGrid
 * Check that Customer Product Review not available in grid
 */
class AssertProductReportByCustomerNotInGrid extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Asserts Customer Product Review not available in grid
     *
     * @param ReviewIndex $reviewIndex
     * @param ReviewInjectable $review
     * @param AssertProductReviewNotInGrid $assertProductReviewNotInGrid
     * @param CustomerReportReview $customerReportReview
     * @param CustomerInjectable $customer
     * @param CatalogProductSimple $product
     * @param string $gridStatus
     * @return void
     */
    public function processAssert(
        ReviewIndex $reviewIndex,
        ReviewInjectable $review,
        AssertProductReviewNotInGrid $assertProductReviewNotInGrid,
        CustomerReportReview $customerReportReview,
        CustomerInjectable $customer,
        CatalogProductSimple $product,
        $gridStatus = ''
    ) {
        $filter = $assertProductReviewNotInGrid->prepareFilter($product, $review, $gridStatus);

        $customerReportReview->open();
        $customerReportReview->getGridBlock()->openReview($customer);
        $reviewIndex->getReviewGrid()->search($filter);
        unset($filter['visible_in']);
        \PHPUnit_Framework_Assert::assertFalse(
            $reviewIndex->getReviewGrid()->isRowVisible($filter, false),
            'Customer review is present in Review grid.'
        );
    }

    /**
     * Text success if review not in grid on product reviews tab
     *
     * @return string
     */
    public function toString()
    {
        return 'Customer review is absent in grid on product reviews tab.';
    }
}
