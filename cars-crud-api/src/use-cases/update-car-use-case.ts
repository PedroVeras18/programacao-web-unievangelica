import { CarsRepository } from '@/repositories/cars-repository'
import { ResourceNotFoundError } from './errors/resource-not-found-error'

interface UpdateCarUseCaseRequest {
  carId: string
  brand: string
  model: string
  year: number
  color: string
}

export class UpdateCarUseCase {
  constructor(private carsRepository: CarsRepository) {}

  async execute({ carId, brand, model, year, color }: UpdateCarUseCaseRequest) {
    const car = await this.carsRepository.findById(carId)

    if (!car) {
      throw new ResourceNotFoundError()
    }

    car.brand = brand
    car.model = model
    car.year = year
    car.color = color

    await this.carsRepository.save(car)
  }
}
