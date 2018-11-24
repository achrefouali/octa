<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Page
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Page
{

    use BaseEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;
	
	
	    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=255, unique=true)
     */
    private $title_en;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255, nullable=true)
     */
    private $summary;
	
	
	
    /**
     * @var string
     *
     * @ORM\Column(name="summary_en", type="string", length=255, nullable=true)
     */
    private $summary_en;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;


    /**
     * @var string
     *
     * @ORM\Column(name="content_en", type="text", nullable=true)
     */
    private $content_en;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @Gedmo\Slug(fields={"title_en"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug_en;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="pages")
     */
    private $menu;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Page
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    public function getTitleEn(): ?string
    {
        return $this->title_en;
    }

    public function setTitleEn(string $title_en): self
    {
        $this->title_en = $title_en;

        return $this;
    }

    public function getSummaryEn(): ?string
    {
        return $this->summary_en;
    }

    public function setSummaryEn(?string $summary_en): self
    {
        $this->summary_en = $summary_en;

        return $this;
    }

    public function getContentEn(): ?string
    {
        return $this->content_en;
    }

    public function setContentEn(?string $content_en): self
    {
        $this->content_en = $content_en;

        return $this;
    }


    public function getSlug()
    {
        return $this->slug;
    }

    public function getSlugEn()
    {
        return $this->slug_en;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setSlugEn(string $slug_en): self
    {
        $this->slug_en = $slug_en;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}

