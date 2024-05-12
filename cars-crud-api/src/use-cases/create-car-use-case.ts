import { CarsRepository } from '@/repositories/cars-repository'

interface CreateCarUseCaseRequest {
  brand: string
  model: string
  year: number
  color: string
}

export class CreateCarUseCase {
  constructor(private carsRepository: CarsRepository) {}

  async execute({ brand, model, year, color }: CreateCarUseCaseRequest) {
    const gym = await this.carsRepository.create({
      brand,
      model,
      year,
      color,
    })

    return {
      gym,
    }
  }
}
